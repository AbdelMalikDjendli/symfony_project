# Projet Symfony - Trouve Ton Match

Bienvenue sur le projet Trouve Ton Match !
Trouve Ton Match est un site permettant à plusieurs utilisateurs de s'inscrire à des fives et de pouvoir les rejoindre. Ce site permet de faciliter la gestion des fives entre amis, ou de facilement pouvoir trouver une équipe adverse.
Pour ce projet, nous avons utilisé PHP à travers le framework Symfony, CSS à travers le framework Bootstrap, ainsi que JavaScript et HTML.
L'IDE sur lequel nous avons développé notre projet est PHPStorm.
Pour une bonne gestion de notre projet, nous avons utilisé Google Meet, Slack, Whatsapp, GitHub et Trello, afin de s'organiser au mieux.

L'utilisation de notre site est assez intuitive. Sur la page d'accueil, vous avez accès aux matchs que vous pouvez rejoindre, uniquement lorsque vous êtes connecté. Depuis votre page du profil, vous avez la possibilité de créer une nouvelle équipe, ainsi que d'ajouter le résultat d'un match que vous avez organisé.
Vous pouvez aussi vous rendre sur le profil d'un autre utilsateur en cliquant sur son nom d'utilsateur, pour y voir ses statistiques, et vous pouvez aussi donner une note à ce joueur, allant de 1 à 5.
Lors de votre inscirption, soyez attentifs au mail de confirmation que vous recevrez sur MailTrap.

## Modèle KanBan
https://trello.com/b/MIHE9t6R/mod%C3%A8le-kanban-php

## Diagramme de classe de la base de données du projet Trouve Ton Match
<img width="501" alt="diagrammeclasse" src="https://user-images.githubusercontent.com/113670994/232299464-d070d92a-9d93-4a9a-ae32-cbdbecc5acc3.png">


## Export de notre base de données en .sql
https://drive.google.com/file/d/1mtKWWxN_lP8DefqkvrLh00wCtOa0SQk3/view?usp=sharing

## Instructions à suivre pour tester les fonctionnalités
Une fois les migrations générées et les DataFixtures chargées, suivez rigoureusement les étapes suivantes :

- Lancez la page "homepage" et naviguez sur la page d'accueil en testant le filtrage et la pagination pour chercher un match précis.
- Lorsqu'un match vous intéresse, vous pouvez le rejoindre en vous connectant.
- Pour cela, créez vous un compte et conservez votre mot de passe. Ayez une photo sous le coude pour l'ajouter à votre profil.
- Une fois connecté, vous avez la possibilité de rejoindre n'importe quel match présent sur la page d'accueil.
- Vous devez en revanche créer une équipe avant de rejoindre un match.
- Cliquez sur "Mon Profil" puis descendez en bas de la page et cliquez sur "Ajouter une équipe".
- Remplissez le formulaire puis retrouvez le match que vous vouliez rejoindre.
- Une fois que vous avez rejoint le match, vous aurez la possibilité de noter l'adversaire que vous avez affronté.
- Vous pouvez retrouver cet adversaire dans > Mon Profil > Mes Matchs en cliquant sur son pseudo (son prénom)
- Vous ne pourrez pas noter un adversaire que vous n'avez pas affronté et vous ne pourrez pas noter deux fois un même adversaire.

Imaginons maintenant que le match s'est déroulé comme prévu et que vous avez gagné.
- Seul l'organisateur peut déterminer le résultat du match. Pour ajouter le vainqueur, connectez vous sur son compte.
- Pour cela, vous devez vous connecter avec son prénom (son pseudo) suivi de '@gmail.com'. Le mot de passe est "TestingVersion11".
- Sur "Mon profil" vous pourrez ajouter le vainqueur à droite du match en question.
- Vous pourrez voir par la même occasion l'historique des matchs effectués par le joueur et chacun des résultats.
- Vous pouvez désormais vérifier sur votre compte que le résultat a bien été actualisé.

Si vous souhaitez ajouter un nouveau five, vous pouvez vous connecter sur le compte admin : 'admin@gmail.com' avec le mot de passe 'TestingVersion11'. En lançant la page "admin", vous aurez accès à tous les matchs stockés dans la base de données ainsi qu'aux différents Fives depuis le dashboard.

Vous avez fait le tour des principales fonctionnalités, merci d'avoir visité TrouveTonMatch.