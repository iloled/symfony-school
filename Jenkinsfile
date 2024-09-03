pipeline {
    agent any

    stages {

        stage('Install Dependencies') {
            steps {
                bat 'composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }

        stage('Run Linter') {
            steps {
                // Run PHP_CodeSniffer
                bat 'vendor/bin/phpcs'
            }
        }

        stage('Run Tests') {
            steps {
                bat './vendor/bin/phpunit'
            }
        }

        stage('Build Docker Image') {
            steps {
                bat 'docker-compose build'
            }
        }

        stage('Deploy to Docker') {
            steps {
                bat 'docker-compose up -d'
            }
        }
    }
}