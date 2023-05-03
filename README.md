# UPHF - ASTRE - Identification & Traçabilité
## Contexte
Lors de ma formation en licence professionnelle A.S.T.R.E. à l'Université Polytechnique des Hautes-de-France, j'ai suivi un cours d'initiation au fonctionnement et à l'utilisation de différents types de codes d'identification à travers le monde comme :
- le code EAN-13
- le code PDF-417
- le QR Code
- le code ITF (2 parmis 5 entrelacé)
- et plein d'autres encore

A la fin de ce cours, notre professeure nous a demandé de réaliser un projet mettant en scène des codes grâce aux connaissances qui nous avaient été fournies.

De plus, nous avions comme base un programme VBA (fichier Excel "Créateur de codes barres.xlsm") réalisant la création d'un code barres EAN-13 suite à la saisie de 12 chiffres. Ce programme VBA a été fourni par notre professeure, Madame Renaux Dominique : https://www.uphf.fr/lamih/membres/renaux_dominique
## Projet
### Idée de base
Mon idée était de réaliser un système ressemblant au fonctionnement d'une caisse enregistreuse, sans contrainte concernant le langage ni la méthode de porgrammation.
### Objectif
Celui-ci devrait être capable de :
- générer des tickets de caisse format texte et format QR-Code indiquant au minimum le nom du produit et son prix
- retirer de la quantité en "stock" des produits achetés
- permettre la gestion graphique de la base de connaissances des produits :
  - afficher les produits, leur quantité, leur code (et optionnellement une image)
  - ajouter un produit inconnu
  - ajouter et retirer une certaine quantité dans les valeurs de "stocks"
  - supprimer un produit connu
## État du projet
J'ai décidé que ce projet serait réalisé via des pages Web usant de PHP et de requêtes SQL. J'ai considéré que cela faisait parfaitement écho à un autre cours que j'ai pu suivre dans le même temps (sources disponible sur mon profil GitHub) : https://github.com/Floksy59/UPHF-ASTRE-TP_PHP
### V.1
Présentation vidéo : https://www.floksy.fr/uphf/identification/Video-Site.mp4

Fonctions actuelles :
- Ajout de produit dans la base (avec photo si on la place au bon endroit et qu'on indique le bon chemin type "images/####.png")
- Modification de quantité dans la base
  - Pour ajouter, il suffit de préciser le code EAN-13 du produit et une quantité, cette quantité sera alors additionnée à celle déjà notée en stock
  - Pour retirer, même principe en ajoutant un `moins` devant la quantité pour la soustraire de celle déjà notée en stock
- Consultation des produits enregistrés ; visualisation possible de :
  - leur nom
  - leur code EAN-13
  - une image
  - leur quantité restante
- Génération de liste de produits achetés avec :
  - sauvegarde locale du fichier texte, QR Code, et trace du passage (ligne dans une table SQL)
  - possibilité d'ajouter un nom et un courriel de client pour étoffer le ticket et le retrouver facilement dans le futur
- Consultation des passages précédents du client via son nom fourni pour retrouver le document format texte et le QR Code


Amélioration envisageables :
- Retrait d'un produit de la base
- Ajout d'un champ "prix" dans la base
- Ajout du prix sur le "ticket"
- Calcul du prix total du panier
- Regroupement par même types d'objets ; au lieu de faire 5 lignes s'il y a 5 bouteilles d'eau, n'en faire qu'une seule avec un champ "Quantité"
- Dans ce cas, ajouter un champ de prix unitaire et un champ de prix du lot complet
- Vérification plus poussée de la bonne lecture des codes EAN-13
- Gestion plus poussée des erreurs de lecture lors de la création du ticket client
- Envoi du ticket et du QR Code par mail à l'adresse fournie
- Consultation libre par le client de ses précédents passages (accès externe aux données)
