#Dashboard

## Fast install
    Install FOSUser Bundle
    Install Assetic Bundle
    Add parameters to config.yml

## To install this project first do 

```
   composer update
```

* Required parameters
```
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: dashboard
    database_user: root
    database_password: null
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: ThisTokenIsNotSoSecretChangeIt

```

* Install FOSUserBundle 
http://symfony.com/doc/current/bundles/FOSUserBundle/index.html

```
            composer require friendsofsymfony/user-bundle "~2.0@dev"
            
            #AppKernel
            new FOS\UserBundle\FOSUserBundle(),
```
* Entity/User.php
```            
            namespace AppBundle\Entity;
            
            use FOS\UserBundle\Model\User as BaseUser;
            use Doctrine\ORM\Mapping as ORM;
            
            /**
             * @ORM\Entity
             * @ORM\Table(name="fos_user")
             */
            class User extends BaseUser
            {
                /**
                 * @ORM\Id
                 * @ORM\Column(type="integer")
                 * @ORM\GeneratedValue(strategy="AUTO")
                 */
                protected $id;
            
                public function __construct()
                {
                    parent::__construct();
                    // your own logic
                }
            }
```            
* app/config/security.yml
```         
            # app/config/security.yml
            security:
                encoders:
                    FOS\UserBundle\Model\UserInterface: bcrypt
            
                role_hierarchy:
                    ROLE_ADMIN:       ROLE_USER
                    ROLE_SUPER_ADMIN: ROLE_ADMIN
            
                providers:
                    fos_userbundle:
                        id: fos_user.user_provider.username
            
                firewalls:
                    main:
                        pattern: ^/
                        form_login:
                            provider: fos_userbundle
                            csrf_token_generator: security.csrf.token_manager
                            # if you are using Symfony < 2.8, use the following config instead:
                            # csrf_provider: form.csrf_provider
            
                        logout:       true
                        anonymous:    true
            
            access_control:
                - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
                - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
                - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
                - { path: ^/admin/, role: ROLE_ADMIN }
                - { path: ^/user, role: ROLE_ADMIN }
                - { path: ^/user/, role: ROLE_ADMIN }
```
* app/config/config.yml
```
            fos_user:
                db_driver: orm # other valid values are 'mongodb', 'couchdb' and 'propel'
                firewall_name: main
                user_class: AppBundle\Entity\User
                
                
                
```
* app/config/routing.yml
```
            fos_user:
                resource: "@FOSUserBundle/Resources/config/routing/all.xml"
```

* Install the assets bundle http://symfony.com/doc/current/assetic/asset_management.html

```
            composer
            composer require symfony/assetic-bundle
```
```
            #AppKernel
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
```            
 * app/config/config.yml
            
```

            assetic:
                debug:          '%kernel.debug%'
                use_controller: '%kernel.debug%'
                filters:
                    cssrewrite: ~
            
```

* Install image location

```
    # app/config/config.yml
    parameters:
        locale: en
        image_directory: '%kernel.root_dir%/../web/uploads/images'
```



##Todo

* User handeling / registratie / login/ logout / user levels - Done!

* Create/ read / EDIT/ Delete

* Menu adding,  Easy content management

* User Blog

* Contact Handling 

* Admin style

* Traffic control / Graphs with data how populair a page is

* Easy template adding/

* Cashe handeling
