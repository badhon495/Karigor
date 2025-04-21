#!/bin/bash

echo "==== PostgreSQL Authentication Fix Tool ===="

# Option 1: Set a new password
set_new_password() {
    echo "Enter a new PostgreSQL password for the 'postgres' user:"
    read -s NEW_PASSWORD
    echo

    if [ -z "$NEW_PASSWORD" ]; then
        echo "Error: Password cannot be empty"
        return 1
    fi

    # Try to set the password
    if sudo -u postgres psql -c "ALTER USER postgres WITH PASSWORD '$NEW_PASSWORD';" > /dev/null 2>&1; then
        echo "Password updated successfully!"
        
        # Update .env file
        sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$NEW_PASSWORD/" .env
        echo "Updated .env file with new password"
        
        return 0
    else
        echo "Failed to set password. Try another method."
        return 1
    fi
}

# Option 2: Create a .pgpass file
create_pgpass() {
    echo "Creating a .pgpass file in your home directory for passwordless authentication"
    
    # Prompt for password
    echo "Enter your current PostgreSQL password (or the password you want to set):"
    read -s PG_PASSWORD
    echo
    
    # Create .pgpass file
    echo "127.0.0.1:5432:*:postgres:$PG_PASSWORD" > ~/.pgpass
    chmod 600 ~/.pgpass
    
    echo "Created ~/.pgpass file with permissions 600"
    echo "This should allow you to connect without entering a password"
    
    # Test the connection
    if psql -h 127.0.0.1 -U postgres -c "\q" > /dev/null 2>&1; then
        echo "Connection successful using .pgpass file!"
        return 0
    else
        echo "Connection still failing. The password might be incorrect."
        return 1
    fi
}

# Option 3: Modify pg_hba.conf to use trust authentication
setup_trust_auth() {
    echo "Setting up 'trust' authentication for local connections"
    
    # Find pg_hba.conf location
    PG_HBA=$(sudo -u postgres psql -t -c "SHOW hba_file;" 2>/dev/null)
    
    if [ -z "$PG_HBA" ]; then
        echo "Could not find pg_hba.conf location"
        return 1
    fi
    
    echo "Found pg_hba.conf at: $PG_HBA"
    
    # Back up the original file
    sudo cp "$PG_HBA" "${PG_HBA}.bak"
    echo "Created backup at ${PG_HBA}.bak"
    
    # Modify file to use trust authentication for local connections
    sudo sed -i 's/\(host.*all.*all.*127.0.0.1\/32.*\)md5/\1trust/' "$PG_HBA"
    sudo sed -i 's/\(host.*all.*all.*::1\/128.*\)md5/\1trust/' "$PG_HBA"
    
    # Restart PostgreSQL
    sudo systemctl restart postgresql
    
    echo "Modified PostgreSQL to use 'trust' authentication for local connections"
    echo "Restarted PostgreSQL service"
    
    # Update .env file to use empty password
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=/" .env
    echo "Updated .env file with empty password (not needed with trust auth)"
    
    # Test the connection
    if psql -h 127.0.0.1 -U postgres -c "\q" > /dev/null 2>&1; then
        echo "Connection successful using trust authentication!"
        return 0
    else
        echo "Connection still failing. Try another method."
        return 1
    fi
}

# Present options to the user
echo "Choose an authentication fix method:"
echo "1) Set a new password for the postgres user"
echo "2) Create a .pgpass file for passwordless authentication"
echo "3) Modify PostgreSQL to use 'trust' authentication (easiest but less secure)"
read -p "Enter your choice (1-3): " CHOICE

case $CHOICE in
    1)
        set_new_password
        ;;
    2)
        create_pgpass
        ;;
    3)
        setup_trust_auth
        ;;
    *)
        echo "Invalid choice"
        exit 1
        ;;
esac

echo
echo "If the selected method worked, you can now run ./migrate_to_postgres.sh again"
echo "If you're still having issues, try another method from this script"