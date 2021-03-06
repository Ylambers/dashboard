#Dashboard

## Fast install
    Install FOSUser Bundle
    Install Assetic Bundle
    Install TinymceBundle
    Add parameters to config.yml

## Links
   * FosUserBundle
    http://symfony.com/doc/current/bundles/FOSUserBundle/index.html
    
   * Assetic Bundle
    http://symfony.com/doc/current/assetic/asset_management.html

   * TinymceBundle
    https://github.com/stfalcon/TinymceBundle

## Commands

```
    Database update
    $ php bin/console doctrine:schema:update --force
    $ php bin/console doctrine:generate:entities AppBundle

```

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

## Install FOSUserBundle 
* http://symfony.com/doc/current/bundles/FOSUserBundle/index.html

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
                - { path: ^/user/, role: ROLE_USER }
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
 app:
     resource: "@AppBundle/Controller/"
     type:     annotation
 
 cursus_create:
     path:     /admin/cursus
     defaults: { _controller: AppBundle:Cursussen:cursus }
 
 cursus_type_create:
     path:     /admin/cursusType
     defaults: { _controller: AppBundle:Cursussen:cursusType }
 
 home:
     path:     /user
     defaults: { _controller: AppBundle:Default:home }
 
 admin:
     path:     /admin
     defaults: { _controller: AppBundle:Admin:index }
 
 user:
     path:     /admin/fos/show
     defaults: { _controller: AppBundle:User:showUsers }
 #user_create:
 #    path:     /admin/fos/show
 #    defaults: { _controller: AppBundle:User:showUsers }
 
 user_edit:
     path:     /admin/fos/edit/{id}
     defaults: { _controller: AppBundle:User:editUser }
 
 user_profile:
     path:     user/profile
     defaults: { _controller: AppBundle:User:userProfile }
 
 user_all_details:
     path:     admin/details/{id}
     defaults: { _controller: AppBundle:User:allUserDetails }
 
 user_password_reset:
     path:     admin/details/{id}
     defaults: { _controller: AppBundle:User:userPasswordReset }
 
 category:
     path:     /admin/category
     defaults: { _controller: AppBundle:Category:createCategory }
 
 category_delete:
     path: /admin/category/delete/{id}
     defaults: { _controller: AppBundle:Category:deleteCategory }
 
 category_edit:
     path: /admin/category/edit/{id}
     defaults: { _controller: AppBundle:Category:editCategory }
 
 image_view:
     path:     /admin/image/show
     defaults: { _controller: AppBundle:Image:showImage }
 
 image_upload:
     path:     /admin/image/upload
     defaults: { _controller: AppBundle:Image:addImage }
 
 image_edit:
     path:     /admin/image/edit/{id}
     defaults: { _controller: AppBundle:Image:editImage }
 
 image_delete:
     path:     /admin/image/delete/{id}
     defaults: { _controller: AppBundle:Image:deleteImage }
 
 item_create:
     path:     /admin/item
     defaults: { _controller: AppBundle:Item:createItem }
 
 item_edit:
     path:     /admin/item/edit/{id}
     defaults: { _controller: AppBundle:Item:editItem }
 
 item_delete:
     path:     /admin/item/delete/{id}
     defaults: { _controller: AppBundle:Item:deleteImage }
 
 slider:
     path:     /admin/slider
     defaults: { _controller: AppBundle:Slider:addSlider }
 
 slider_edit:
     path:     /admin/slider/edit/{id}
     defaults: { _controller: AppBundle:Slider:editSlider }
 
 slider_delete:
     path:     /admin/slider/delete/{id}
     defaults: { _controller: AppBundle:Slider:deleteSlider }
 
 logout:
     path: /logout
 
 
 _errors:
     resource: "@TwigBundle/Resources/config/routing/errors.xml"
     prefix:   /_error
 
 fos_user:
     resource: "@FOSUserBundle/Resources/config/routing/all.xml"
 
 fos_user_register:
     resource: "@FOSUserBundle/Resources/config/routing/registration.xml"
     prefix: /user/fos/registration
 
 register:
     resource: "@FOSUserBundle/Resources/config/routing/registration.xml"
     prefix: /registration
    
```

## Install the assets bundle 

* http://symfony.com/doc/current/assetic/asset_management.html
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
* Use Bootstrap form style

```
    twig:
        debug:            "%kernel.debug%"
        strict_variables: "%kernel.debug%"
        form_themes: ['bootstrap_3_layout.html.twig']
```


## Install tinymceBundle

https://github.com/stfalcon/TinymceBundle

            ```
            //app/AppKernel.php
            new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),
            
            ```
* $ php app/console assets:install web/
* Add tinymce to a form 
    ```
        $builder->add('introtext', 'textarea', array(
            'attr' => array(
                'class' => 'tinymce',
                'data-theme' => 'bbcode' // Skip it if you want to use default theme
            )
        ));
    ```
    
    
#add service controller
    ```
    services:
        general_service:
            class: AppBundle\Controller\ServiceController
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

* Image encode to base64

* User information table, connect to fos_users