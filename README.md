# wp-rest-template-block-builder

The `wp-rest-template-block-builder` enables you to create custom Gutenberg blocks, which can use data they get from a REST API.
To create new blocks the [Vue.js Template Syntax](https://vuejs.org/v2/guide/syntax.html) is used.

> This plugin was not intended to work with APIs that need a REST-API key. If you need that - you need another plugin.
 
There are similar WordPress plugins that offer more features than the `wp-rest-template-block-builder`. 
But at the time of writing, these plugins lack support for WordPress nonces and are quite resource intensive.
If these issues do not bother you - you may want to consider using those other solutions - since they support requests using API-keys which are needed for many external APIs. 

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Development](#development)
- [Support](#support)
- [Contributing](#contributing)

## Installation

To build `wp-rest-template-block-builder` you need have `npm` installed.
Additionally you need the tools, which are available via a `coreutils` package on most Unix-like systems (Linux, Mac).
You'll have to figure out how to build it on Windows yourself, but that shouldn't be too hard. Just read the `build.sh`.

Clone this repository and execute `build.sh` to build an installable zip-file.

```sh
git clone https://github.com/jdillenberger/wp-rest-template-block-builder
cd ./wp-rest-template-block-builder
bash ./build.sh
```

You can now upload the installable zip-archive in WordPress admin to install and then activate it. [More Information ](https://wordpress.org/support/article/managing-plugins/#manual-upload-via-wordpress-admin)

## Usage

### Create new Blocks

After the plugin is installed and activated. You can start by creating a new block. Select `REST-Blocks` > `New Block` via the main admin menu in WordPress.  

![Admin Interface to create a new Block](https://cloud.jandillenberger.com/index.php/apps/files_sharing/publicpreview/bsmrk2WGbKqg6FH?fileId=5912&file=/new-block.png&x=2560&y=1440&a=true)

There you can choose a `Block Title`, which you can later use to identify the block inside the Gutenberg Editor.
After that use the `Use Apis` field to specify the number of APIs you want to query for your block.
Then you can start to configure each API. Enter an `API Name` the `API URL` and if used the [Nonce](https://codex.wordpress.org/WordPress_Nonces) name you need for that request.
Each API you entered will be shown on the right side of the block content editor.

Now you can use this data to create your block. Each specified API will be available as a variable in your template matching the `API Name` used for that API.
The Template Language used to create the blocks is the [Vue.js Template Syntax](https://vuejs.org/v2/guide/syntax.html). 

Furthermore the `All Blocks` Section enables you to get an overview over all the blocks.

![Admin Interface to list all existing Blocks](https://cloud.jandillenberger.com/index.php/apps/files_sharing/publicpreview/bsmrk2WGbKqg6FH?fileId=5910&file=/all-blocks.png&x=2560&y=1440&a=true)

### Use Blocks in Gutenberg

When the block is created. It can be used inside of the `Gutenberg Editor` (the default WordPress page/post editor). 
Seach the available blocks for a `REST Template Block` and select it.
The block provides a select box which you can use to select the `Block Title` you used for your block.
Now just save your page or post and view the post to examine it on your page. 

![Gutenberg REST Template Block](https://cloud.jandillenberger.com/index.php/apps/files_sharing/publicpreview/bsmrk2WGbKqg6FH?fileId=5938&file=/gutenberg-block.png&x=2560&y=1440&a=true)

## Development

### Development Environment

To use the development environment - you need to have `Vagrant` installed.
If this is done, you can change into the main project directory and type `vagrant up`.
This will setup a virtual machine containing a WordPress instance with wp-rest-template-block-builder installed, but not activated.

After the VM is booted up, the most relevant links are by default:
- [WordPress Frontend](http://192.168.13.37/wordpress)
- [WordPress Admin Interface](http://192.168.13.37/wordpress/wp-admin)
- [phpMyAdmin](http://192.168.13.37/phpmyadmin/)

> The default links may not work if you have other VMs running, that wants to use the same url.

You can login to the WordPress admin interface or to phyMyAdmin as:
- **Username:** admin
- **Password:** 1234

> The vagrant-box was created for easy development, not as a secure server. Please do not make them available over the Internet. 

### Development Version Build

To create the JavaScript code as a development version that allows easier debugging. Use the following command from within the project directory:

```
npm run dev
```

## Support

Please [open an issue](https://github.com/jdillenberger/wp-rest-template-block-builder/issues/new) for support.

## Contributing

Please contribute using [Github Flow](https://guides.github.com/introduction/flow/). Create a branch, add commits, and [open a pull request](https://github.com/jdillenberger/wp-mintfit/compare).
