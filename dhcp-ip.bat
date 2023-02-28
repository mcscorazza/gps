@echo off
echo Choose:
echo [A] Set Static IP to 192.168.1.102
echo [B] Set DHCP
echo ================================

:choice
SET /P C=[A or B]?
if [%C%]==[A] goto A
if [%C%]==[B] goto B
goto choice

:A
@echo off
echo Setting static IP address: 192.168.1.102
netsh interface ip set address "Ethernet X" static 192.168.1.102 255.255.255.0 192.168.1.1
netsh interface ip add dns "Ethernet X" addr="8.8.4.4"
netsh interface ip add dns "Ethernet X" addr="8.8.8.8"
netsh interface ip show config "Ethernet X"
pause
goto end

:B
@echo off
echo Enabling DHCP
netsh interface ip set address "Ethernet X" source=dhcp
netsh interface ip set dnsservers "Ethernet X" source=dhcp
netsh interface ip show config "Ethernet X"
pause
goto end

:end