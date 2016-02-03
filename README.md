OwnCloud REST Auth
============

Initial project to add REST authentication support to OwnCloud.


Installation
-----

1) Get the source code from this repository cloning it or downloading a zip file

2) Copy the folder "restauth" and paste in the "apps" folder of your OwnCloud installation

3) Edit restauth/lib/configuration.php with the right informations about your REST service (TODO)

4) Restart OwnCloud

5) Access the OwnCloud's admin area and search for "Rest Auth" application at disabled applications list

6) Click at install button


![Installed Sample](sample.jpg?raw=true)


TODO
-----

- Enable configurations to be dynamic managed by user
- Add suport to POST and PUT methods in REST calls
- Make it turn a real user backend instead a user creation wrapper


