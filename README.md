## About The Project

This repository contains a Dockerized Laravel application designed for local development.

**Note**: My primary framework is Symfony, but for this test assignment, I opted to use Laravel in order to express my framework independence.

<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

Ensure you have Docker and Docker Compose installed on your machine.

### Setup and Build

1. Clone the repo
   ```sh
   git clone git@github.com:bumblecoder/tech-task-pay.git
   cd tech-task-pay
   cp code/.env.example code/.env
   ```
2. Build and start the Docker containers:
   ```sh
   make build
   ```
   This command will build and start the necessary Docker containers. The process may take some time.

3. Access the application:

   By default, the application will be available on port 80 of localhost. Ensure this port is available; otherwise, the build may fail.

   Open your browser and go to http://localhost:8010.

## API Endpoints

The following API endpoints are available:

- GET /validate-transaction - manual testing of the validation

<!-- LICENSE -->
## License

GNU GENERAL PUBLIC LICENSE
