#!ipxe
# change: 06.12.2018 M.Schlimm: Script created
# change:
# change:
#########################################################################

echo Bootfile: ${net0/filename}
echo Menufile: custom/${mac:hexhyp}.php
echo Booting up from Ivanti DSM Prod


####### Boot Ivanti DSM Prod #######
kernel wimboot
initrd winpeboot-V1/bootmgr				bootmgr
initrd winpeboot-V1/boot/BCD			BCD
initrd winpeboot-V1/boot/boot.sdi		boot.sdi
initrd winpeboot-V1/boot/WINPE40.WIM	WINPE40.wim
imgstat
boot


