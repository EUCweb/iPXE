#!ipxe
# change: 06.12.2018 M.Schlimm: Script created
# change:
# change:
# example: booting custom/50-6B-8D-D7-94-06.php if exist or boot.php
##########################################################################
chain custom\${mac:hexhyp}.php || chain boot.php
