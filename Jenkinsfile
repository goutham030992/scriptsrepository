pipeline {
  agent any
  stages {
    stage('Test') {
      steps {
        sh '''ssh 10.0.0.67
sudo su
cd /users
mkdir test-user'''
      }
    }
  }
}