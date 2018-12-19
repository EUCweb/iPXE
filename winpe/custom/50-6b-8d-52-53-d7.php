#!ipxe
# change: 06.12.2018 M.Schlimm: Script created
# change:
# change:
##########################################################################

set pvs-server 10.46.128.1

echo Bootfile: ${net0/filename}
echo Menufile: custom/${mac:hexhyp}.php
echo Booting up from Citrix PVS ${pvs-server}

### connect to PVS Server
chain tftp://${pvs-server}/ARDBP32.BIN

