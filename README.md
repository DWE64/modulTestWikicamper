### informations sur le développement ###
Cette application a été réalisée en seulement 16h de développement. Ce temps de développement n'a malheureusement pas put 
être plus long pour cause de contraintes de clients et de temps. L'application de test a donc été réalisée sur le temps libre restant.
Par ailleurs ce délai de développement très court a fait que les bash de lancement du projet n'ont pas put être testé.
Il est donc possible que des erreurs surviennent lors du lancement du projet.
Si tel est le cas, merci de me contacter à l'adresse suivante: `contact@dwe64.com` ou par téléphone au `06 66 69 15 57`

### Prérequis ###

Tout d'abord, assurez-vous d'avoir docker installé.

### lancement du projet ###
Ensuite pour lancer le projet, il suffit d'exéuter le bash contenu dans le dossier `bashSetup` 
et correspondant à votre système d'exploitation.

Une fois les containers lancés, vous pourrez accder à l'application via l'url `https://testwikicamper.local:8503/`
Si malgré tout vos container sont lancé mais que vous n'accédez pas à l'url, vérifier que le bash à bien inscrit dans le fichier hosts
l'ip associé à l'url. Si ce n'est pas le cas, ajoutez la ligne suivante dans votre fichier hosts:
`127.0.0.1    testwikicamper.local`

pour accéder aux différents compte, vous pouvez utiliser les identifiants suivants:
username propriétaire : `owner@testwikicamper.com`
password propriétaire : `owner`

username locataire : `tenant@testwikicamper.com`
password locataire : `tenant`

### Choix de conception et fonctionnalité implémentée ###
Pour la base de donnée, j'ai choisie une base de donnée postgresql pour diverse raison:
- Le moteur est très performant
- le langage est très stricte et beaucoup moins permissif que mysql
- il est beaucoup plus adapté pour des structure d'application vouée à grandir.

Pour l'envoi de mail, j'ai choisi d'utiliser le service messenger de symfony afin de ne pas bloquer les envois lors des interaction utilisateur.
Le système de filtrage des annonces est basé sur un datatable contenant les nom de villes dans lesquelle les annonces sont localisé.
Un filtrage plus poussé aurait put être mit en place mais faute de temps il ne l'a pas été.
Le projet manque également d'un peu de javascript pour l'expérience utilisateur (notamment avec la mise en place de loader lors des chargements).

Pour finir, je n'ai absoluement pas utilisé bundler Js pour compiler mes éléments pour plusieurs raisons:
- Symfony dans sa dernière version propose un mapper qui permet d'installer uniquement les librairies liées au projet.
- cela évite l'installation d'un service supplémentaire comme yarn ou node, très lourds en ressource.
- et parce que mettre un bundler nécessitant l'utilisation de node pour un projet aussi petit, n'était pas pertinent.