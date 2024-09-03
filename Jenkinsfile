pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/your-username/your-symfony-project.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }

        stage('Run Linter') {
            steps {
                // Run PHP_CodeSniffer
                sh 'vendor/bin/phpcs --standard=PSR12 src/'

                // Optionally, run PHP-CS-Fixer to fix issues
                sh 'vendor/bin/php-cs-fixer fix --dry-run --diff src/'
            }
        }

        stage('Run Tests') {
            steps {
                sh './vendor/bin/phpunit --testdox'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker-compose build'
            }
        }

        stage('Deploy to Docker') {
            steps {
                sh 'docker-compose up -d'
            }
        }
    }
}