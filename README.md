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
app:
    resource: "@AppBundle/Controller/"
    type:     annotation

admin:
    path:     /user
    defaults: { _controller: AppBundle:Admin:index }

category:
    path:     /user/category
    defaults: { _controller: AppBundle:Category:createCategory }

category_delete:
    path: /user/category/delete/{id}
    defaults: { _controller: AppBundle:Category:deleteCategory }

category_edit:
    path: /user/category/edit/{id}
    defaults: { _controller: AppBundle:Category:editCategory }

image_view:
    path:     /user/image/show
    defaults: { _controller: AppBundle:Image:showImage }

image_upload:
    path:     /user/image/upload
    defaults: { _controller: AppBundle:Image:addImage }

image_edit:
    path:     /user/image/edit/{id}
    defaults: { _controller: AppBundle:Image:editImage }

image_delete:
    path:     /user/image/delete/{id}
    defaults: { _controller: AppBundle:Image:deleteImage }


item_create:
    path:     /user/item
    defaults: { _controller: AppBundle:Item:createItem }

item_edit:
    path:     /user/item/edit/{id}
    defaults: { _controller: AppBundle:Item:editItem }

item_delete:
    path:     /user/item/delete/{id}
    defaults: { _controller: AppBundle:Item:deleteImage }

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