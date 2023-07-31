# User App 🧑‍💻👩‍💻

### TO DO:
#### Requirements

To perform this task, you will need to use the following technologies:

* Laravel 10
* InertiaJS
* VueJS 3
* TailwindCSS

### The Task

We require you to build a simple Laravel application that will allow a user to log in or register, and update their details. They should be able to update these details through a web interface as well as an API request.

A user must have:

* Name
* Email
* Password
* Rules

**Please do not use Laravel Jetstream for this task, we want to see what you can do - not see if you can initialize a package correctly.**

You can use whichever packages aid you in the development of this task, as long as they aren’t doing the task for you.

### The Extended Task

An extended task would be to allow these users to generate API tokens as well.

# App Start-up instructions
## Docker is in the `docker` folder, to start the app you need only need to run
  ```
  ./start.sh
  ``` 
  to set everything up.

### Access the app
To access the app type `http://localhost` in You browser of choice.

### Entering dev container
  To enter the workspace docker container navigate to docker folder:
  ```
  cd docker
  ``` 

SSH to the container with:
  ```
  docker compose exec workspace bash
  ``` 
