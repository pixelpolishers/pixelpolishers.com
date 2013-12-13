# Reset the current source and then get the latest source code:
git reset --hard HEAD
git pull origin

# Retrieve the latest dependencies:
php composer.phar self-update
php composer.phar update --no-interaction --no-dev

# Make sure that all the needed files are executable:
chmod 0777 build.sh
