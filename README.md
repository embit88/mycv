# Start Project (Dev)
1) sudo bash ./run-dev.sh

# Start Project (Prod)
1) sudo bash ./run-prod.sh

# Settings
1) In File: appConfig.ts

# Deploy

# допустим system user = mymeinuser
mkdir -p /var/www/vhosts/system/mymein.com/home/mymein.com_ogzvy2ruozm/.ssh
chmod 700 /var/www/vhosts/system/mymein.com/home/mymein.com_ogzvy2ruozm/.ssh
echo "ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIGxcrn1aNt7p7ccB/Uraw7XcfIwB/+fhU7LlfT+JVVJq github-deploy" > /var/www/vhosts/system/mymein.com/home/mymein.com_ogzvy2ruozm/.ssh/authorized_keys
chmod 600 /var/www/vhosts/system/mymein.com/home/mymein.com_ogzvy2ruozm/.ssh/authorized_keys
chown -R mymein.com_ogzvy2ruozm:psacln /var/www/vhosts/system/mymein.com/home/mymein.com_ogzvy2ruozm/.ssh