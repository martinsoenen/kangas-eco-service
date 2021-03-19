/* Pour un éventuel lecteur : on n'a pas utilisé les fixtures car nous n'avons pas eu le temps */

/*utilisateur(Mot de passe : Admin1234@)*/

insert into utilisateur (id, email, civilite, password, nom,prenom,utilisateur_type, telephone) VALUES (1,'john@gmail.com', 'mr', '$2y$13$iduJalEuGNgwjfvpSVr9P.bSsiLhkClDC/Cuo3vF/ogMn5S2OPOlO','Doe','John', 'client', 0876767887 );
insert into utilisateur (id, email, civilite, password, nom,prenom,utilisateur_type, telephone) VALUES (2,'jane@gmail.com', 'mme', '$2y$13$iduJalEuGNgwjfvpSVr9P.bSsiLhkClDC/Cuo3vF/ogMn5S2OPOlO','Doe','Jane', 'client', 0876756887 );
insert into utilisateur (id, email, password, nom, prenom, utilisateur_type, telephone, raison_sociale, siret, fonction_representant) VALUES (3,'robert.dufour@gmail.com','$2y$13$iduJalEuGNgwjfvpSVr9P.bSsiLhkClDC/Cuo3vF/ogMn5S2OPOlO','Dufour','Robert', 'pro', 0876767887, 'Carrefour', 12345678912345, 'RH' );
insert into utilisateur (id, email, civilite, password, nom,prenom,utilisateur_type, telephone) VALUES (4,'admin@admin.com', 'mr', '$2y$13$iduJalEuGNgwjfvpSVr9P.bSsiLhkClDC/Cuo3vF/ogMn5S2OPOlO','Admin','Admin', 'admin', 0876546887 );

/*adresse*/

insert into adresse(id, utilisateur_id, nom, numero_rue, type_rue, nom_rue, cp, ville) VALUES (1, 1, 'Maison' ,69, 'rue' ,'de la Gigue', 75001, 'Paris');
insert into adresse(id, utilisateur_id, nom, numero_rue, type_rue, nom_rue, cp, ville) VALUES (2, 1, 'Cave' ,70, 'rue' ,'de la Rue', 13001, 'Marseille');
insert into adresse(id, utilisateur_id, nom, numero_rue, type_rue, nom_rue, cp, ville) VALUES (3, 2, 'Maison' ,14, 'avenue' ,'de la santé', 69009, 'Lyon');

/*article*/

insert into article(id, titre, text, date, image) VALUES (1, 'Se laver les mains de manière éco-responsable', 'Trouvez le ruisseau le plus proche de chez vous. Plongez-y vos mains en les ayant préalablement badigeonnées de savon éco-responsable. Ne vous inquiétez pas, il n\'y a pas de virus dans l\'eau.',now(), 'ruisseau-main.jpg');
insert into article(id, titre, text, date, image) VALUES (2, 'Comment sont faits nos yaourts frais ?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'yaourt.png');
insert into article(id, titre, text, date, image) VALUES (3, 'Tout savoir sur nos pansements', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'pansements.jpg');
insert into article(id, titre, text, date, image) VALUES (4, 'A propos du liquide vaisselle', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'liquide-vaisselle.jpg');
insert into article(id, titre, text, date, image) VALUES (5, 'Concernant notre produit nettoyant', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'nettoyant.jpg');
insert into article(id, titre, text, date, image) VALUES (6, 'Découvrez notre table en bois et ses chaises', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'table.jpg');
insert into article(id, titre, text, date, image) VALUES (7, 'Vidéo d\'utilisation du produit nettoyant', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'nettoyant.jpg');
insert into article(id, titre, text, date, image) VALUES (8, 'Article 8', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'yaourt.png');
insert into article(id, titre, text, date, image) VALUES (9, 'Article 9', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'yaourt.png');
insert into article(id, titre, text, date, image) VALUES (10, 'Article 10', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'yaourt.png');
insert into article(id, titre, text, date, image) VALUES (11, 'Article 11', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda atque aut commodi, corporis culpa cum dolorem earum facilis magni minus modi molestiae molestias nam odio officiis, optio, perspiciatis quae quis recusandae reprehenderit repudiandae sapiente similique soluta sunt temporibus ut veniam. Aspernatur atque autem commodi dignissimos doloribus eveniet facere facilis fuga illo labore nostrum nulla odio optio perferendis quia quidem repudiandae saepe sed sit, veniam. Accusantium aperiam assumenda at autem eligendi error excepturi ipsam ipsum minus nam natus nemo nesciunt nobis odit perspiciatis placeat quam quod quos reprehenderit, repudiandae rerum sapiente tempora. Accusamus aut dicta distinctio dolore dolores earum eius explicabo fuga id, incidunt, inventore, iure molestias nam possimus quidem quo sapiente unde? Accusamus animi aperiam architecto at beatae corporis culpa deserunt eaque enim et facilis fuga, in inventore laborum minus molestiae neque nesciunt nobis optio quae quisquam ratione sit suscipit ut voluptates. Atque necessitatibus nobis omnis, repellat rerum tempore?',now(), 'yaourt.png');

/*categorie-produit*/
insert into categorie_produit(id, nom) VALUES (1, 'Nourriture');
insert into categorie_produit(id, nom) VALUES (2, 'Santé');
insert into categorie_produit(id, nom) VALUES (3, 'Produits ménager');
insert into categorie_produit(id, nom) VALUES (4, 'Jardin');
insert into categorie_produit(id, nom) VALUES (5, 'Emballages');
insert into categorie_produit(id, nom) VALUES (6, 'Produits de maquillage');
insert into categorie_produit(id, nom) VALUES (7, 'Accessoires');

/*commande*/
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (1, 1, now(), 1, 8.25, 150, 158.25, -1, 'PAY-ID-AZERTYUIOPQSDFGCFG', 'John Doe|Bâtiment de l\'eau|19 rue Jean Moulin|69000 LYON');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (2, 2, now(), 1, 0.06, 1, 1.06, 1, 'PAY-ID-AZERTYUIOPQSDFGMLK', 'Jane Doe|Bâtiment C|9 Avenue Jean-Claude Bernard|69000 LYON');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (3, 1, now(), 1, 30, 150, 180, 1, 'PAY-ID-AZERTYUIOPQSDFGPIH', 'John Doe|Bâtiment C|1 Rue Jacques Petit|74000 ANNECY');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (4, 2, now(), 1, 38.25, 300, 338.25, 1, 'PAY-ID-AZERTYUIOPQSDFGNNH', 'Jane Doe|Bâtiment Les Sources|190 Boulevard de Balmont|74000 ANNECY|');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (5, 3, now(), 1, 0.5, 5, 5.5, 1, 'PAY-ID-AZERTYUIOPQSDFGMVC', 'Robert Dufour|Carrefour|139 Rue Cyrian|74150 RUMILLY');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (6, 4, now(), 2, 3, 15, 18, 1, 'PAY-ID-AZERTYUIOPQSDFGGTY', 'Admin Admin|Bâtiment C|190 Rue Jean-Marc Généreux|10000 TROYES');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (7, 1, now(), 1, 0.5, 5, 5.5, 0, 'PAY-ID-AZERTYUIOPQSDFGJUI', 'John Doe|Bâtiment Les Sources|1 Impasse des Poireaux|10150 PONT-SAINTE-MARIE');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (8, 1, now(), 1, 1, 5, 6, 0, 'PAY-ID-AZERTYUIOPQSDFGFRT', 'John Doe|Bâtiment Les Sources|190 Rue Jean Moulin|42000 SAINT-ETIENNE');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (9, 3, now(), 1, 1, 5, 6, 0, 'PAY-ID-AZERTYUIOPQSDFGDER', 'Robert Dufour|Carrefour|18 Rue La Salle|01150 AMBERIEU EN BUGEY');
insert into commande(id, user_id,date, nb_articles, montant_tva, montant_ht, montant_total_ttc, is_send, pay_pal_id, shipping_addr) VALUES (10, 1, now(), 1, 1, 5, 6, 0, 'PAY-ID-AZERTYUIOPQSDFGNBV', 'John Doe|Bâtiment Les Sources|19 Rue Hervé Poilan|42000 SAINT-ETIENNE');/*sous-categorie-produit*/

/*sous-categorie-produit*/

insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (1, 1, 'Produits frais');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (2, 1, 'Féculents');	
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (3, 1, 'Produits surgelés');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (4, 2, 'Paramédical');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (5, 2, 'Médicaments');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (6, 3, 'Produits pour le sol');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (7, 3, 'Lessive');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (8, 3, 'Liquides');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (9, 4, 'Tables');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (10, 4, 'Graines');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (11, 5, 'Emballages réutilisables');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (12, 5, 'Emballages recyclés');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (13, 6, 'Visage');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (14, 6, 'Corps');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (15, 7, 'Torchons');
insert into sous_categorie_produit (id, categorie_produit_id, nom) VALUES (16, 7, 'Eponges');

/*produit*/

insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (1,1,'Yaourt',1,5.5, 'Yaourt frais' ,'Yaourt crémeux BIO de la ferme d\'à-côté.', 'yaourt.png' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (2,1,'Viande de boeuf',150,5.5,' Boeuf de qualité', 'Boeuf de grande qualité eco-responsable.', 'viande-boeuf.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (3,2,'Pâtes',10,5.5, 'Pâtes fraiches' , 'Pâtes à l\'italienne à cuire à l\'eau.', 'pates_rigatoni.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (4,3,'Viande surgelé',15,5.5,' Viande animale surgelée' ,'Viande animale surgelée par nos soins.', 'viande-surgelee.jpeg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (5,4,'Pansements',4,5.5,'Pansements résistants','Pansements de qualité ultra-résistants et water-proof.', 'pansements.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (6,4,'Spray nasal',5,5.5,'Spray puissant','Spray nasal de qualité supérieure et issu de recherches en laboratoires éco-responsables.', 'spray-nasal.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (7,5,'Huiles essentielles',10, 10, ' Huile odorante' , 'Huiles essentielles de qualité pour vous soigner.', 'huile-odorante.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (8,6,'Produit nettoyant',5,10, 'Produit nettoyant au vinaigre blanc', 'Produit produit de manière éco-responsable. A base de vinaigre blanc.', 'nettoyant.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (9,7,'Lessive',15,10, 'Lessive bonne pour la planète','Lessive parfaite pour vous. Produite de manière éco-responsable, elle est bonne pour la planète et pour votre corps.', 'lessive.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (10,8,'Liquide vaisselle',5,10, 'A base de vinaigre blanc','Liquide vaiselle à base d\'huiles essentielles et de vinaigre blanc.', 'liquide-vaisselle.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (11,9,'Table en bois',500,20,'Au bois de nos forêts', 'Table en bois recyclé suédoise.', 'table.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (12,9,'Chaise en bois',50,20,'Au bois de nos forêts','Chaise en bois recyclé suédoise.', 'chaise.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (13,10,'Graines de courge',5,20,'Pour votre potager','Graines de courges bio décortiquées.', 'graines-de-courge-decortiquees.jpeg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (14,10,'Graines de blé',5,20, 'Pour votre potager','Graines de blé bio.', 'graines-blé-tendre.png' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (15,11,'Film en plastique',5,20, 'Emballez proprement.','Film en plastique pour emballer vos aliments. Le plastique est issu d\'une agriculture éco-responsable.', 'film-plastique.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (16,12,'Film en plastique recyclé',50,20, 'Emballé, c\'est pesé.' ,'Film en plastique recyclée.', 'film-plastique2.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (17,13,'Base de maquillage',50,20, 'Pour votre peau', 'Base de maquillage éco-responsable.', 'base-maquillage.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (18,13,'Kit de maquillage',150,20, 'Parce que vous le valez bien','Kit de maquillage éco-responsable.', 'kit-maquillage.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (19,13,'Dentifrice',5,20, 'Dents blanches garanties ', 'Dentifrice qualitatif à l\'aloe vera. Produit de façon éco-responsable.', 'dentifrice.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (20,14,'Gel douche',10,20, 'Pour se laver en respectant la planète','Gel douche solide à l\'eau de raisin. Produit de façon éco-responsable.', 'gel-douche.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (21,14,'Crème pour le corps',10,20, 'Hydratez votre peau' ,'Crème pour le corps grasse. Produite de façon éco-responsable.', 'creme.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (22,16,'Eponge vaiselle',5,20, 'A la plonge !' ,'Eponge vaiselle recyclée et recyclable à l\'infini.', 'eponge.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (23,16,'Eponge carrée',5,20, 'Ménagez-vous','Eponge carrée multi-surfaces. Produite de façon éco-responsable.', 'eponge-carree.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (24,15,'Torchon en fibres recyclées',10,20, 'Mieux qu\'un essuie-tout' ,'Torchon de haute qualité, éco-responsable. Plus efficace qu\'un essuie-tout et 100% recyclé et recyclable', 'torchon.jpg' );
insert into produit (id, sous_categorie_produit_id, nom_produit, prix_unitaire_ht, taux_tva, presentation, description_detaillee, image) VALUES (25,15,'Torchon basique',10,20, 'Comme un essuie-tout' ,'Torchon de haute qualité. Produit de façon éco-responsable.', 'torchon2.jpg' );

/*commande-produit*/

insert into commande_produit(commande_id, produit_id) VALUES (1,2);
insert into commande_produit(commande_id, produit_id) VALUES (2,1);
insert into commande_produit(commande_id, produit_id) VALUES (3,18);
insert into commande_produit(commande_id, produit_id) VALUES (4,2);
insert into commande_produit(commande_id, produit_id) VALUES (4,18);
insert into commande_produit(commande_id, produit_id) VALUES (5,8);
insert into commande_produit(commande_id, produit_id) VALUES (6,19);
insert into commande_produit(commande_id, produit_id) VALUES (6,20);
insert into commande_produit(commande_id, produit_id) VALUES (7,10);
insert into commande_produit(commande_id, produit_id) VALUES (8,13);
insert into commande_produit(commande_id, produit_id) VALUES (9,14);
insert into commande_produit(commande_id, produit_id) VALUES (10,15);