# Start Project (Dev)
1) sudo bash ./run-dev.sh

# Start Project (Prod)
1) sudo bash ./run-prod.sh

# Settings
1) In File: appConfig.ts

# Deploy
sudo adduser deploy
sudo chsh -s /bin/bash deploy

sudo usermod -aG docker deploy
sudo newgrp docker

sudo mkdir -p /home/deploy/.ssh
sudo chmod 700 /home/deploy/.ssh
sudo echo "ssh-rsa deploy_key" | sudo tee /home/deploy/.ssh/authorized_keys
sudo chmod 600 /home/deploy/.ssh/authorized_keys
sudo chown -R deploy:deploy /home/deploy/.ssh

sudo chown -R deploy:deploy /var/www/vhosts/mymein.com/httpdocs
sudo chmod -R u+rwX /var/www/vhosts/mymein.com/httpdocs

# Apache & nginx Settings for domain:
ProxyPreserveHost On
ProxyPass / http://127.0.0.1:3000/
ProxyPassReverse / http://127.0.0.1:3000/

# PATH SITE
/var/www/vhosts/domain.com/httpdocs