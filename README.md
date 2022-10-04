# SITE_NAME

SITE_NAME website with docker, PHP, Apache, MySQL and phpmyadmin.


## Main Configuration

### Configure docker containers

In docker >> docker-compose.yml find replace test by project name and change all the port for web, db & phpmyadmin.


### Configure Xdebug

1. In PhpStorm go to: File | Settings | PHP | Debug, in Xdebug >> Debug port enter the port number (9010 for example).
2. Click on ADD Configurations (next phone symbole):
  - In left of pop-up window click on + and choose PHP Remote Debug;
  - Enter Name: Localhost (for example);
  - Check: Filter debug connection by IDE key;
  - In Server click in: ...;
  - In left off the pop-up window click on +;
  - Enter Localhost for Name (for example);
  - Enter Localhost for Host,
  - Enter the port number (check the web port in docker-compose);
  - Select Use path mappings;
  - in Project files >> got to your project root path >> next src enter: /var/www/html;
  - Click: Apply.
3. Download the [Xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc) (Google Chrome extension) and in options >> IDE key copy "PHPSTORM".
4. Back in Run/Debug Configuration in IDE key(session id) enter the copied IDE key (PHPSTORM) then click Apply.
5. In Menu >> Run >> select : Break at first line in PHP scripts.
6. Click on the phone symbole until it change to green and in browser click on Xdebug helper until it change to green also
7. Go to your home page website and click f5 to refresh.
8. Finally, in Run >> uncheck : Break at first line in PHP scripts.


## Main Tasks

To do ...


### Install maker
 in du branch i have i big problem with installing the bundel maker 

  Problem 1
    - symfony/maker-bundle v1.43.0 requires symfony/config ^5.4.7|^6.0 -> found symfony/config[v5.4.7, v5.4.8, v5.4.9, v5.4.11, v6.0.0, ..., v6.1.3] but these were not loaded, likely because it conflicts with another require.
    - symfony/maker-bundle[v1.44.0, ..., v1.46.0] require php >=8.0 -> your php version (7.4.30) does not satisfy that requirement.
    - Root composer.json requires symfony/maker-bundle ^1.43 -> satisfiable by symfony/maker-bundle[v1.43.0, v1.44.0, v1.45.0, v1.46.0].
 I resouled the probleme with presing le version the bundel :
     `composer require --dev symfony/maker-bundle:1.39.0`

composer require debug   

 pour presenter la bare du debugaje au desu 

 composer require form 
 pour install liberaire form

 ### 10-Twig Les thèmes de formulaires livrés avec Symfony

    il faut ajouter sur twig.yaml
         form_themes:
      - bootstrap_4_layout.html.twig 

  ### pour persiste dans la db  il faut d'abord inject EntityManagerInterface $em
      apres en $em->persiste();  //preparation du données selemeent en premiere creation   pas en modife et remove
            et  $em->flush();

  ### Install composant du security
    'composer req security'  
    il ajouter dans la fichier bundel 
       Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    et il modife la  fichier security.yaml

  ### make:user
    'symfony make:user User

    il cree une entity user avec repository et modife le fichie security.yaml
  ### Autowiring
   "symfony debug:autowiring "
   pour montrer le service possible par exemple symfony debug:autowiring password