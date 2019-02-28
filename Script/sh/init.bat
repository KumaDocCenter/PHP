:: ============================================================================= ::
:: �Ӳֿ��ʼ��
:: ����֧����
::
:: ���˽ű���ScriptĿ¼һ���Ƶ��Ӳֿ��Ŀ¼��
:: ע�� ͨ��������˽ű�������ϻ�ɾ������
::
:: ���Ŀ¼�� ./Script/sh 
:: ����Ŀ¼�� ./ 
:: 
:: ֧�ִ��ļ�(LFS)
:: ============================================================================= ::


:: ===================================����Ԥ����========================================== ::
:: �رջ���
@echo off
:: ���������ӳ�
setlocal enabledelayedexpansion
:: ������ɫ
color 0A

:: ���Կ���
set debug=0

:: ��ǰ�ļ���
set this=%0

:: �洢��̾�� ! 
set "T=^!"

:: cd��ת����Ŀ¼(��Ϊ��ǰ���Ŀ¼��./Script/sh��������Ҫ����)
cd %~dp0
cd..
cd..
:: ���ø�Ŀ¼·��
set root=%cd%
:: ���õ�ǰ�ű�·��
set thispath=%~dp0


if %debug%==1 echo ------------------------ ��������ʱ���ʱ���  ----------------------

:: ���ڷָ���
set delim=-

:: ���ڴ���( 2018-12-10 )
for /f "tokens=1-4  delims=/ " %%a in ("%date%") do (
	set _de=%%a%delim%%%b%delim%%%c
	set de=%%a%%b%%c
	set week=%%d
)
:: ʱ�䴦��( 21:43:58 )
for /f "tokens=1-4  delims=:." %%a in ("%time%") do (
	set _ti=%%a:%%b:%%c
	set ti=%%a%%b%%c
)

:: ��ǰ����ʱ��( 2018-12-10 21:43:58 )
set "datetime=%_de% %_ti%"
echo ����ʱ�䣺"%datetime%"

:: ����ʱ�� ��( 20181207180016 )
set deti=%de%%ti%
:::: ȥ�����пո�
set timestamp=%deti: =%
echo ʱ�����"%timestamp%"
if %debug%==1 echo ------------------------ ��������ʱ���ʱ���  ----------------------


if %debug%==1 echo ------------------------ ��ȡĿ¼��  ----------------------

::::::::::::����ʾ��::::::::::::::::::::::::
::set spath=DevDocCenter
::set dpath=DevDocCenter_md

::echo cd: %cd%
::call :getPath_byStr  %cd%  %spath%  .
::echo beforePath: %beforePath%
::echo afterPath: %afterPath%
::echo beforePathF: %beforePathF%
::echo afterPathF: %afterPathF%
::echo cd2: %cd%

set _destDirName=DevDocCenter
call :getPath_byStr  %root%  %_destDirName%  .
:: ����Ŀ¼��
set dirname=%afterPathF%
echo Ŀ¼��: %dirname% 

if %debug%==1 echo ------------------------ ��ȡĿ¼��  ----------------------
:: ===================================����Ԥ����========================================== ::



:: ===================================���ĵ��ü���־����========================================== ::

:: ��־����
set log=1
:: ��־�ļ���
set logName=%dirname%.init.log
:: ���� ANSI ����ҳ,�����ַ�������ȷʶ�� 
chcp 936 
 
:: ���ü���־����
if %log%==1 (
	@call :output>%logName%
) else (
	call :output
)

:: ɾ�����ű�
::del %0
exit
GOTO:EOF
:: ===================================���ĵ��ü���־����========================================== ::



:: ===================================���Ĵ���========================================== ::
:output

:: ---------------------------------- Ԥ����  ---------------------------------- ::

:::::::::::::::::::::::::git���ݿ��ж�:::::::::::::::::::::::::::::::::::
:: ����git���ݿ⣬���˳��ű�������ִ�нű�
IF EXIST .git (
    echo .git �ļ��д���	
	exit
) ELSE (
    echo ִ�в���... 
)
:::::::::::::::::::::::::git���ݿ��ж�:::::::::::::::::::::::::::::::::::

echo ����ʱ�䣺%datetime%
echo ʱ�����%timestamp%
echo Ŀ¼��: %dirname% 

:::::::::::::::::::::::::�ض�Ŀ¼����:::::::::::::::::::::::::::::::::::
:: ָ��Ŀ¼�����ڣ��򴴽�
IF NOT EXIST "doc/md" ( mkdir "doc/md" )
IF NOT EXIST "doc/Readme" ( mkdir "doc/Readme" )
:::::::::::::::::::::::::�ض�Ŀ¼����:::::::::::::::::::::::::::::::::::


:::::::::::::::::::::::::��Ŀ¼����:::::::::::::::::::::::::::::::::::
:: ���ڿ�Ŀ¼������ .gitkeep �ļ�

:: -------------------------------------------------------- ::
:: for ѭ�� ('dir /ad /b /s')�е�Ϊ��ǰλ���µ�����Ŀ¼ȫ·���ļ��ϡ�
:: ��,
:: E:\share\z
:: E:\share\xshell
:: E:\share\cmder
:: 
:: for ѭ�� ('dir "%%i" /a /b')���ٴν������·������dir��
:: ���Ŀ¼Ϊ��(������Ŀ¼���ļ�)���򲻻����κ������
:: �� for /f %%j in ('dir "%%i" /a /b') Ϊfalse������ִ��do��������
::
:: set n=0 : ��� for /f %%j in ('dir "%%i" /a /b')  ��䡣
:: for /f %%j in ('dir "%%i" /a /b') Ϊtrue�������ǿ�Ŀ¼ʱ��n+1
:: !n! : ������!���������ܶ�ȡ set /a n+=1 �е�n
:: if !n!==0 : ��ʾ��һ�����δִ�У��������ֿ�Ŀ¼ %%i
:: �� %%i ��һ��Ҫ������ļ��������Ӧ��
:: -------------------------------------------------------- ::
for /f "delims=" %%i in ('dir /ad /b /s') do (
    set n=0
    for /f %%j in ('dir "%%i" /a /b') do ( set /a n+=1 )
    if !n!==0 echo git��Ŀ¼���� >%%i\.gitkeep
)
:::::::::::::::::::::::::��Ŀ¼����:::::::::::::::::::::::::::::::::::



:: ---------------------------------- Ԥ����  ---------------------------------- ::


echo ------------------------ �ֿ�����  ------------------------ 

echo ��ʼ���ֿ�...
git init

echo �����û���...
git config user.name "kuma8866"

echo ��������... 
git config user.email "kuma8866@163.com" 

echo �����ύ����...
git config http.postBuffer  524288000   

echo ����Զ�ֿ̲�...
git remote add origin https://github.com/KumaDocCenter/%dirname%.git


echo ------------------------ �ֿ�����  ------------------------ 

:: bat������<>&�ȷ���������ļ���
:: �������ǰ���^
:: echo #include ^<stdio.h^> >.1.txt
:: ����հ� echo.
:: echo.  >>.gitignore
:: ����setlocal EnableDelayedExpansion ��!�ͱ�������,������ˣ�
:: ������Ҫ��ǰ���棡�ڱ����С�


echo ------------------------START: Commit_0  ------------------------ 
:: �ύ�հײֿ⣬ֻ���� .gitignore �ļ�

echo ��� .gitignore...
echo /start.bat >>.gitignore
echo !T!.gitignore >>.gitignore

echo ���ӵ��ݴ�...
git add .gitignore

echo git�ύ...
git commit -m "Commit_0 : init"

echo ------------------------END: Commit_0  ------------------------ 



echo ------------------------START: Commit_1  ------------------------ 
::  ���������ļ�

echo ��� .gitignore...
echo .DS_Store >.gitignore
echo Thumbs.db >>.gitignore
echo /start.bat >>.gitignore
echo !T!.gitignore >>.gitignore
echo !T!.gitattributes >>.gitignore
echo !T!**/.gitkeep >>.gitignore
echo !T!**/*.exe >>.gitignore
echo !T!*.exe >>.gitignore

echo ���ô��ļ�(LFS)֧��
git lfs install

echo ���� .gitattributes... 
xcopy  %thispath%.gitattributes   %root%\  /Y

echo ���ӵ��ݴ�...
git add .

echo git�ύ...
git commit -m "Commit_1 : + All file"

echo ------------------------END: Commit_1  ------------------------ 


echo ------------------------ ���ƹ���  ------------------------
:: ������󣬱��ⲻ��Ҫ�Ĵ���
:: ֻ��������ģ�飬�Ӳֿⲻ��Ҫ�˹���
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
:: ���ù�������
REM set hookname=post-commit
:: �����򱸷�
REM if exist ".git\hooks\%hookname%"  (
REM 	ren .git\hooks\%hookname%   %hookname%.%timestamp%  
REM )
:: ���ƹ���
REM xcopy  Script\hook\SubRepo\%hookname%   .git\hooks\  /Y
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 

echo ------------------------ ���ƹ���  ------------------------


echo ------------------------ YAML���  ------------------------


:: ���ýű�
call %~dp0YAMLwrite.bat

echo ���ӵ��ݴ�...
git add .

echo git�ύ...
git commit -m "Commit_3 : + md's YAML"


echo ------------------------ YAML���  ------------------------

echo ------------------------ �������  ------------------------

REM ��ֵ������Ϊ ""
:: gitǰ׺
set gitPrefix=https://github.com/KumaDocCenter/
:: ��֧
set branch=master
:: ���з�֧(master:md)
set branchs=master
:: ��ģ��ǰ�ű�
set submodule_sh=""
:: ��ģ���ű�
set submodule_sh2=Script\sh\submodule_hanlde.bat
:: �ֿ�ǰ�ű�
set Repo_sh=""
:: �ֿ��ű�
set Repo_sh2=""


:: �����ģ�������ļ�
call  :out_ConfigFile  %dirname%  %timestamp%  "%datetime%" add 	%branch%  %branchs%   %submodule_sh%  %submodule_sh2%  %gitPrefix%
call  :out_ConfigFile  %dirname%  %timestamp%  "%datetime%" init	%branch%  %branchs%   %submodule_sh%  %submodule_sh2%  %gitPrefix%
call  :out_ConfigFile  %dirname%  %timestamp%  "%datetime%" update	%branch%  %branchs%   %submodule_sh%  ""  %gitPrefix%
call  :out_ConfigFile  %dirname%  %timestamp%  "%datetime%" del	    %branch%  %branchs%   %submodule_sh%  ""  %gitPrefix%

:: ����ֿ������ļ�
call  :out_ConfigFile  %dirname%  %timestamp%  "%datetime%" Repoadd 	%branch%  %branchs%   %Repo_sh%  %Repo_sh2%  %gitPrefix%
call  :out_ConfigFile  %dirname%  %timestamp%  "%datetime%" Repoupdate	%branch%  %branchs%   %Repo_sh%  %Repo_sh2%  %gitPrefix%
call  :out_ConfigFile  %dirname%  %timestamp%  "%datetime%" Repodel	    %branch%  %branchs%   %Repo_sh%  %Repo_sh2%  %gitPrefix%

echo.
echo ------------------------ �������  ------------------------

echo ########################## �鿴��� ##########################
echo.
git branch -v

echo -----------------------------------------------------------

git log
echo.
echo ########################## �鿴��� ##########################


:: ===================================���Ĵ���========================================== ::




GOTO:EOF
:: ================================================== ::
:: �������ƣ�getPath_byStr							  ::
:: �������ܣ���ȡ·��(�ַ����滻����) 				  ::
:: ����������arg1: ����cd·�� 						  ::
::           	   ���ڸ�λ(K:\DevDocCenter\Ajax\doc) ::
::           arg2: Ŀ��Ŀ¼�� 		  				  ::
::           	   ����ƥ��(DevDocCenter)	 		  ::
::         [arg3]: ·���ָ��� 		  				  ::
::           	   ���ڸ�ʽ��·��			 		  ::
:: ����ֵ�� 									 	  ::
:: 	   %beforePath% :  ǰ·��				  		  ::
:: 		  			   �磬K:\DevDocCenter			  ::
:: 		%afterPath% :  ��·��				  		  ::
:: 		  			   �磬Ajax\doc					  ::
:: 	  %beforePathF% :  ��ʽ��ǰ·��				   	  ::
:: 		  			   �磬K:.DevDocCenter 			  ::
:: 	   %afterPathF% :  ��ʽ����·��				 	  ::
:: 		  			   �磬Ajax.doc		  	 		  ::
:: ================================================== ::
:getPath_byStr
if %debug%==1 echo Localtion: %this%: %~0 .................
if %debug%==1 echo ---arg0: %~0 
if %debug%==1 echo ---arg1: %~1 
if %debug%==1 echo ---arg2: %~2 
if %debug%==1 echo ---arg3: %~3 
if %debug%==1 echo ---arg4: %~4 
if %debug%==1 echo ---arg5: %~5
if %debug%==1 echo ---arg6: %~6 
if %debug%==1 echo ---arg7: %~7 
if %debug%==1 echo ---arg8: %~8
if %debug%==1 echo ---arg9: %~9
if %debug%==1 echo Localtion: %this%: %~0 .................


:: ����cd·��
set inCD=%~1
:: Ŀ��Ŀ¼��
set DestDirName=%~2
:: ·���ָ���
set Pdelim=%~3

:: ��ǰcdĿ¼��
set ThisDirName=

:: ��ת������cd
cd %inCD%

:: ʾ���� K:\DevDocCenter\Ajax\doc

:getDocRoot_Loop
:: EQU - ���� 
if "!ThisDirName!" EQU "%DestDirName%" ( 
	REM ǰ·��
	REM K:\DevDocCenter
	set beforePath=%cd%
)

:: EQU - ���� 
if "!ThisDirName!" EQU "%DestDirName%" (	
	REM ��·��( ǰ·��\ �滻Ϊ�� )
	REM Ajax\doc
	set afterPath=!inCD:%beforePath%\=!
	
	REM  NEQ - ������
	if "%delim%" NEQ "" (
		REM	��ʽ��·��
		set beforePathF=!beforePath:\=%Pdelim%!
		set afterPathF=!afterPath:\=%Pdelim%!
	)
	
	REM cd��λ
	cd %inCD%
	GOTO:EOF
)

:: ��ת���ϼ�Ŀ¼
cd..
:: ������ȡĿ¼��
for %%i in ("!cd!\.") do (
  if %debug%==1 echo �ļ���: %%~ni
  set ThisDirName=%%~ni
)

GOTO getDocRoot_Loop
GOTO:EOF



GOTO:EOF
:: ================================================== ::
:: �������ƣ�out_ConfigFile							  ::
:: �������ܣ���������ļ�							  ::
:: ����������arg1: ��ģ��(�ֿ�)��	 	  			  ::
::                 �����·��				 		  ::
::           arg2: ʱ��� 						  	  ::
::           arg3: ����ʱ��						  	  ::
::           arg4: ����ļ�����					  	  ::
::                 ֵ( [Repo]add | [Repo]init |		  ::
::                     [Repo]update | [Repo]del )	  ::
::           arg5: �����֧						  	  ::
::           arg6: ���з�֧						  	  ::
::                 �磬master:md					  ::
::           arg7: ����ǰ���õĽű�				  	  ::
::           arg8: ��������õĽű�				  	  ::
::           arg9: gitǰ׺						  	  ::
::                 ��https://github.com/KumaDocCenter/::
:: ����ֵ�� 									 	  ::
:: 													  ::
:: ================================================== ::
:out_ConfigFile
if %debug%==1 echo Localtion: %this%: %~0 .................
if %debug%==1 echo ---arg0: %~0 
if %debug%==1 echo ---arg1: %~1 
if %debug%==1 echo ---arg2: %~2 
if %debug%==1 echo ---arg3: %~3 
if %debug%==1 echo ---arg4: %~4 
if %debug%==1 echo ---arg5: %~5
if %debug%==1 echo ---arg6: %~6 
if %debug%==1 echo ---arg7: %~7 
if %debug%==1 echo ---arg8: %~8
if %debug%==1 echo ---arg9: %~9
if %debug%==1 echo Localtion: %this%: %~0 .................
SETLOCAL  
::::::::::��������::::::::::::::::
set "_dirname=%~1"
set "_timestamp=%~2"
set "_datetime=%~3"
set "_type=%~4"
::::::::::��������::::::::::::::::


::::::::::��������::::::::::::::::
set "dn=%_dirname%.%_timestamp%.%_type%"
set git=%~9%_dirname%.git
set name=%_dirname%
set branch=%~5
set branchs=%~6
set "init_date=%_datetime%"
set sh=%~7
set sh2=%~8

REM %~dp0 : K:\...\Script\sh\

:: ������ʾ����
set viewname=��ģ��
if "%_type%" EQU "Repoadd"  set viewname=�ֿ�
if "%_type%" EQU "Repoinit"  set viewname=�ֿ�
if "%_type%" EQU "Repoupdate"  set viewname=�ֿ�
if "%_type%" EQU "Repodel"  set viewname=�ֿ�

::::::::::��������::::::::::::::::

if %debug%==1 echo ------------------------ ���%viewname%�����ļ�  ------------------------
echo ###################################################### >%dn%
echo #  %viewname%�����������ļ� >>%dn%
echo #  >>%dn%
echo # ����ʱ�䣺%_datetime%  >>%dn%
echo #------------------------------------------------ >>%dn%
echo #  ��׺   		���� >>%dn%
echo # .[Repo]add        ���� >>%dn%	
echo # .[Repo]init	      ��ʼ�� >>%dn%
echo # .[Repo]update	  ���� >>%dn%
echo # .[Repo]del		  ɾ�� >>%dn%
echo #------------------------------------------------ >>%dn%
echo #  git        :  git ��ַ >>%dn%
echo #  name       :  %viewname%���� >>%dn%
echo #  branch     :  %viewname%��֧ >>%dn%
echo #  branchs    :  %viewname%���з�֧  >>%dn%
echo #  init_date  :  %viewname%��ʼ��ʱ�� >>%dn%
echo #  sh  	   	  :  ����ǰ���õĽű� >>%dn%
echo #  sh2  	  :  ��������õĽű� >>%dn%
echo ###################################################### >>%dn%
echo git=%git%>>%dn%
echo name=%name%>>%dn%
echo branch=%branch%>>%dn%
echo branchs=%branchs%>>%dn%
echo init_date=%init_date%>>%dn%
echo sh=%sh%>>%dn%
echo sh2=%sh2%>>%dn%

echo. 
echo ����%viewname%�������ļ������ɣ��뾡��ת���ļ�
echo [ %dn% ]
echo.
if %debug%==1 echo ------------------------ ���%viewname%�����ļ�  ------------------------
ENDLOCAL
GOTO:EOF

