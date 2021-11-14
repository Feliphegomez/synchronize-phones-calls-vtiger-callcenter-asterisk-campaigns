# synchronize-phones-calls-vtiger-callcenter-asterisk-campaigns

Synchronize phone book synchronize campaigns out asterisk callcenter to vtiger 7 (DEV)
Sincronice los contactos y los prospectos de las campañas de vTiger 7 con su consola de CallCenter y maneje la libreta de telefonos de las campañas de salida de manera rapida y facil.

#### Donate: 
	0x8dc25A4b4117915Ca6F79aa0e608F0192CD652AA (ETH-BAT-BNB)

### Config
1. Copie el contenido del repositorio en la carpeta final, ejemplo: `/var/www/html/vtiger/callcenter`.
2. Modifique el archivo `database.php` que se encuentra dentro de la carpeta `config` con los datos de los accesos y bases de datos de (Asteris, CallCenter, vTiger 7).
3. Ingrese a http://myserver-or-myip/vtigercrm/callcenter (Ruta segun el ejemplo anterior)

### Uso
1. Crear Campaña en vTiger
2. Agregar o Seleccionar Contactos y/o Prospectos
3. Ir a https://192.168.88.206/vtigercrm/callcenter/ y crear la campaña de salida para el Dialer.
4. Sincronizar la informacion del vTiger (Contactos y/o Prospectos) con la campaña del dialer.
5. Activar la campaña del Dialer.

Nota: Si la campaña es activada sin contactos dentro de ella, esta sera desactivada por el Dialer de manera automatica, por ende debe incluir minimo 1 telefono para ser contactado.
