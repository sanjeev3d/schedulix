node {
	gitrepo = checkout scm
	gitBranch = gitrepo.GIT_BRANCH

	try {
	
		stage('checkout'){
			checkout scm	//checkout		
		}

	if (gitBranch == 'origin/staging') {
		stage('Updating Staging server'){
			withCredentials([
			 	sshUserPrivateKey(credentialsId: 'ssh-stag', keyFileVariable: 'SSHPASS'), 
			 	file(credentialsId: 'bit-cred', variable: 'BITCRED')]) {
                    ansiblePlaybook become: true, colorized: true, credentialsId: 'ssh-stag', disableHostKeyChecking: true, inventory: './ansible-code/inventory',limit: 'stag', extras: '-e branch="staging" -e keyfile="${BITCRED}"', playbook: './ansible-code/bitclone.yml'
                    }
		}
	}

	if (gitBranch == 'origin/master') {
		stage('Updating Production Server'){
			withCredentials([
			 	sshUserPrivateKey(credentialsId: 'ssh-stag', keyFileVariable: 'SSHPASS'), 
			 	file(credentialsId: 'bit-cred', variable: 'BITCRED')]) {
                    ansiblePlaybook become: true, colorized: true, credentialsId: 'ssh-stag', disableHostKeyChecking: true, inventory: './ansible-code/inventory',limit: 'prod', extras: '-e branch="master" -e keyfile="${BITCRED}"', playbook: './ansible-code/bitclone.yml'
                    }
			}
		}
	}
	catch (e) {
    // If there was an exception thrown, the build failed
    currentBuild.result = "FAILED"
    throw e
  }
    finally {
          echo "Current Jenkins pipeline name: $env.JOB_NAME"
          echo "Current branch: $gitrepo.GIT_BRANCH"
		   }
	
}