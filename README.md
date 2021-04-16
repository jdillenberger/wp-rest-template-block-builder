# wp-rest-template-block-builder

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
git clone git@github.com:jdillenberger/wp-mintfit.git
cd ./wp-mintfit
bash ./build.sh
```

You can now upload the installable zip-archive in WordPress admin to install and then activate it. [More Information ](https://wordpress.org/support/article/managing-plugins/#manual-upload-via-wordpress-admin)

## Usage

### Admin Sections

### Gutenberg Blocks

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
