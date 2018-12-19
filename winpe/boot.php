#!ipxe

set menu-timeout 5000
set submenu-timeout ${menu-timeout}
set pvs-server 10.46.128.1

isset ${menu-default} || set menu-default exit

####### Boot Menu #######
:start
menu Default iPXE's Boot Menu
item --gap --             ---------------------- System Information ----------------------------
item --gap --             Manufacturer: ${manufacturer}
item --gap --             Product name: ${product}
item --gap --             Bootfile: ${net0/filename}
item --gap --             Menufile: boot.php
item --gap --             MAC address: ${net0/mac}
item --gap --             IP address: ${net0/ip}
item --gap --             DHCP: ${net0/dhcp-server}
item --gap --             -------------------- Production Boot Options -------------------------
item localHDDboot-ID0 01 - Boot from local Disk
item winpeboot-V1 02 - Reinstall Computer - Boot Ivanti DSM Prod
item pvstftpboot-v1 03 - Citrix PVS TFTP Boot from ${pvs-server}
item --gap --             ------------- Test and Troubleshooting Boot Options ------------------
item winpeboot-V2 10 - Reinstall Computer - Boot Ivanti DSM TEST
item winpeboot-V99 11 - WinPE x64 english Standard only
item --gap --             ---------------------------- System ----------------------------------
item reboot 98 - Reboot System
item exit 99 - Exit iPXE

choose --default localHDDboot-ID0 --timeout 10000 target && goto ${target}


####### Boot Ivanti DSM Prod #######
:winpeboot-V1
kernel wimboot
initrd winpeboot-V1/bootmgr				bootmgr
initrd winpeboot-V1/boot/BCD			BCD
initrd winpeboot-V1/boot/boot.sdi		boot.sdi
initrd winpeboot-V1/boot/WINPE40.WIM	WINPE40.wim
imgstat
boot


####### PVS TFTP Boot ######
:pvstftpboot-v1
chain tftp://${pvs-server}/ARDBP32.BIN


####### Boot Ivanti DSM TEST #######
:winpeboot-V2
kernel wimboot
initrd winpeboot-V2/bootmgr				bootmgr
initrd winpeboot-V2/boot/BCD			BCD
initrd winpeboot-V2/boot/boot.sdi		boot.sdi
initrd winpeboot-V2/boot/WINPE40.WIM	WINPE40.wim
imgstat
boot


####### WinPE x64 English #######
:winpeboot-V99
kernel wimboot
initrd winpeboot-V99/bootmgr			bootmgr
initrd winpeboot-V99/boot/BCD			BCD
initrd winpeboot-V99/boot/boot.sdi		boot.sdi
initrd winpeboot-V99/sources/boot.WIM	boot.wim
imgstat
boot

:localHDDboot-ID0
chain grub.exe --config-file="rootnoverify (hd0);chainloader +1"


:reboot
reboot

:exit
exit



