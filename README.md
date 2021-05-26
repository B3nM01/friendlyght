# friendlyght
PHP - Javascript based UI for c-lightning, backelor's degree thesis project.

For the installation the first and last thing to do is to put the friendlyght root inside a path wich is accessible from the server service and to grant to the server-runner user to use c-lightning.

For the restart feature in the options it's needed to have c-lightning running as a service. 

For the notifications service it's needed to launch c-lightning with the plugin option -plugin=/pathtofryendlyght/plugins/notipy.py, it is also needed to grant the execution privilege to notipy.py file. 

It's recommended to activate https on the server.

Initial password is "pass", you can change it in the file login.php, look it's a double sha256-hash.

Use the config.php file to set the network on wich your lightning node is running, you can also choose which api friendlyght will'use. Rpc-api.php it's strongly recommended.

Soon a mobile css style will be available.

For the dynamic generation of qr-images it's included in this project phpqrcode http://phpqrcode.sourceforge.net/

 
