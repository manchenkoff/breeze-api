<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Breeze API template

This repository is a template for Laravel projects based on Sail environment to integrate with the Sanctum authentication.

You can use this project to integrate with one of these frontend applications:

-   [Breeze Next](https://github.com/laravel/breeze-next/) (React)
-   [Breeze Nuxt](https://github.com/manchenkoff/breeze-nuxt) (Nuxt)

## Prerequisites

To work with this project you will also need to install the following software:

-   [Git](https://git-scm.com/)
-   [Docker](https://docker.com/)
-   [Taskfile](https://taskfile.dev/)

## Features

-   Laravel 11
-   Breeze API with Sanctum
-   Laravel Pint code formatter
-   Larastan static analysis rules
-   IDE helper for Laravel (Stubs generation)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/manchenkoff/breeze-api
```

2. Build the project and install dependencies:

```bash
task build
```

3. Start the project:

```bash
task start
```

Once the project is started, you can access it at [http://localhost](http://localhost).

## Development

To get more details about available commands in `taskfile`, run the following command:

```bash
task -a
```

To auto-format your code use `task fmt` command and also `task lint` to check the code quality by running Larastan checks.
