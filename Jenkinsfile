pipeline {
    agent any

    stages {

        stage('Install Dependencies') {
            steps {
                bat 'composer install --no-interaction'
            }
        }

        stage('Run Linter') {
            steps {
				catchError(buildResult: 'UNSTABLE', stageResult: 'UNSTABLE') {
					bat 'php vendor/bin/phpcs src/'
				}
            }
        }

        stage('Run Tests') {
            steps {
                bat 'php vendor/bin/phpunit'
            }
        }

        stage('Deploy to Docker') {
            steps {
                bat 'docker-compose up --build -d'
            }
        }
    }
}