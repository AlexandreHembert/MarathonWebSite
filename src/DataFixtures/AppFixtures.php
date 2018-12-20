<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use App\Entity\Chapitre;
use App\Entity\Genre;
use App\Entity\Histoire;
use App\Entity\Suite;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {
        // $product = new Product();
        // $manager->persist($product);
        $genreSF = new Genre();
        $genreSF->setLabel("SF");
        $manager->persist($genreSF);
        $genre = new Genre();
        $genre->setLabel("Comics");
        $manager->persist($genre);

        $user = new User();
        $user->setNom("Duchmol");
        $user->setPrenom("Robert");
        $user->setEmail("Robert.Duchmol@marathon.com");
        $user->setPassword($this->passwordEncoder->encodePassword($user,'secret'));
        $manager->persist($user);

        $asimov = new User();
        $asimov->setNom("Asimov");
        $asimov->setPrenom("Isaac");
        $asimov->setEmail("azimov@gmail.com");
        $asimov->setPassword($this->passwordEncoder->encodePassword($asimov,'secret'));
        $manager->persist($asimov);

        $histoire = new Histoire();
        $histoire->setTitre('z1 ou la vie d\'un demi-octet');
        $histoire->setPitch("z1 n'a pas une vie très compliquée. Quelque soit la question, la réponse se limite à 0 ou 1. 
             En même temps, cela lui permet au mois de représenter des nombres en mode binaire. C'est déjà cela !");
        $histoire->setPhoto("https://bathboxoffice.org.uk/wp-content/uploads/2017/10/the-octet-logo-mall-2.jpg");
        $histoire->setUser($user);
        $histoire->setActif(true);
        $histoire->setGenre($genreSF);
        $manager->persist($histoire);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('nom long du chapitre et 1');
        $chapitre->setTitreCourt('et 1');
        $chapitre->setTexte("Aujourd'hui z1 ne sait pas trop quel nombre il va représenter. Tout dépend déjà de la première question.");
        $chapitre->setPhoto("https://bathboxoffice.org.uk/wp-content/uploads/2017/10/the-octet-logo-mall-2.jpg");
        $chapitre->setQuestion("Est-ce-qu'ul fait beau aujourd'hui ?");
        $chapitre->setPremier(true);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('nom long du chapitre et 2');
        $chapitre->setTitreCourt('et 2');
        $chapitre->setTexte("Dommage, le ciel est gris. Mais ce n'est pas grave !. Aujourd'hui z1 représentera un petit nombre... Et cette deuxième question, où va-t-elle nous amener ?");
        $chapitre->setPhoto("https://img.20mn.fr/XDQLMICIT4KqIOy3ubcYIg/310x190_homme-marche-sous-pluie-a-caen-9-juin-2014.jpg");
        $chapitre->setQuestion("Prêt pour aller voir Ready Player One ?");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('nom long du chapitre autre et 2');
        $chapitre->setTitreCourt('autre et 2');
        $chapitre->setTexte("Super, il fait beau !!!! A partir de la, le plus grand bit de z1 est vrai. Quelle fierté. Mais quel suspense, Que va t il se passer maintenant ? ");
        $chapitre->setPhoto("https://www.lsa-conso.fr/mediatheque/2/4/0/000144042_5.jpg");
        $chapitre->setQuestion("Un tour à la plage ou une marche ?");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('nom long du chapitre et 3 zéro !!');
        $chapitre->setTitreCourt('et 3 zéro !!');
        $chapitre->setTexte("Elle est pourtant bien cette histoire. z1 est vraiment ronchon aujourd'hui. Que des zeros, 
            Il représente donc le néant, le vide, rien, le zéro quoi.. Demain sera un autre jour, espérons que cela finisse mieux");
        $chapitre->setPhoto("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBF26Ci41Ys3I9jbIbYyWF4NAKl6VADyioelHpvGm4b9wJmgza");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('nom long du chapitre autre et 3 zéro !!');
        $chapitre->setTitreCourt('autre et 3 zéro !!');
        $chapitre->setTexte("Super, réprésentant le 1, c'est pas mal d'aller voir Ready Player One !!");
        $chapitre->setPhoto("https://img.bfmtv.com/c/1256/708/00f29/b41bac1ae3222f9b727c6198f2e.jpeg");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('nom long du chapitre autre 2 et 3 zéro !!');
        $chapitre->setTitreCourt('autre 2 et 3 zéro !!');
        $chapitre->setTexte("La plage, le soleil, la mer !!! Représenter un 2, ca a du bon quelque fois !");
        $chapitre->setPhoto("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDHh_Cu9fL0f0d-7EejUzb1XzNPyfgu7RZLlUweSswf8anOevY6Q");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('nom long du chapitre autre 3 et 3 zéro !!');
        $chapitre->setTitreCourt('autre 3 et 3 zéro !!');
        $chapitre->setTexte("Belle journée pour z1. Il ne possède que des 1 ! En allant marcher il croisera peut-être les 3 petits cochons. ");
        $chapitre->setPhoto("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgrp7jlZZSLC8iejw3NGoSkvo8JCE7VxZ0uhSNuaiVNzVSRydt");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);
        $manager->flush();

        $repChapitre = $manager->getRepository('App\Entity\Chapitre');
        $suite = new Suite();
        $chapitre = $repChapitre->find(1);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(2);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse(0);
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(1);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(3);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse(1);
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(2);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(4);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse(0);
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(2);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(5);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse(1);
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(3);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(6);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse(0);
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(3);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(7);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse(1);
        $manager->persist($suite);

        $histoire = new Histoire();
        $histoire->setTitre('THX1138');
        $histoire->setPitch("THX1138 est un robot mal dans sa peau et qui cherche un sens à sa vie.");
        $histoire->setPhoto("https://m.media-amazon.com/images/M/MV5BYzRiY2I3M2EtODJkMy00NTEyLTgxNmYtYzYwYjk1ZDE1MDE1XkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_UY1200_CR111,0,630,1200_AL_.jpg");
        $histoire->setActif(true);
        $histoire->setUser($asimov);
        $histoire->setGenre($genreSF);
        $manager->persist($histoire);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('Les oracles');
        $chapitre->setTitreCourt('Les oracles');
        $chapitre->setTexte("<p>Le robot, privé de certains capteurs sensoriels, vivait particulièrement mal sa désorientation
        temporo-spatiale. Son degré de sensibilité était devenu très élevé avec la mise à jour 2187
        version THX 1138. Cette légère défaillance le désobligeait, autant techniquement que parce
        qu&#39;elle ternissait sa réputation de modèle incomparable, de must de la robotique
        intelligente, de George Clooney version Asimov. </p><p>
        Au seuil de l&#39;atelier, il dut se résoudre à faire ce pour quoi il était pourtant programmé,
        demander de l&#39;aide. Issu de la dernière génération des robots dotés d&#39;intelligence artificielle
        créée derrière les hauts murs du Consortium Robotique International Libertaire, le CRIL, une
        forteresse classée AAA dans les milieux autorisés, il avait appris à choisir.</p>");
        $chapitre->setPhoto("https://www.cril-limouzi.com/img/lgm-production-logo-1505993315.jpg");
        $chapitre->setQuestion("Sonner ? Téléphoner ? Demander conseil aux trois Fred, les oracles technologiques d&#39;un
        monde nouveau, FredH, FredB et FredZ ?");
        $chapitre->setPremier(true);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('Boum !');
        $chapitre->setTitreCourt('Boum !');
        $chapitre->setTexte("La sonnette eut à peine le temps de retentir qu&#39;une déflagration d&#39;une violence
        sismique marqua d&#39;une fine rayure son Kevlar renforcé et explosa totalement son
        réseau neuronal artificiel en même temps que tout le réseau synaptique de synthèse
        associé. Il avait cédé à la plus ancienne des ruses développées par les SolBots,
        compter sur un réflexe d’humain : sonner à une porte. Le piège était grossier, il était
        tombé dedans. A force de s’humaniser, il eut à peine le temps de comprendre qu’il
        mourait d’avoir trop ressemblé aux hommes. <b>Fin de partie.</b>");
        $chapitre->setPhoto("http://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Explosions.jpg/800px-Explosions.jpg");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('Dring !');
        $chapitre->setTitreCourt('Dring !');
        $chapitre->setTexte("La sonnerie du téléphone ne fit que retentir dans un silence assourdissant qui lui
        pesa tant qu&#39;il ressentit une solitude poisseuse, presque philosophique. Rien à faire, il
        entendait cette musique ultrasonique et familière de la tentative de connexion
        neuronale, celle qui avait remplacé les appels classiques. Rien, le néant, le vide
        sidéral.");
        $chapitre->setPhoto("https://cdnb.artstation.com/p/assets/images/images/004/706/561/large/nicolas-martinez-matrix-telephone-1.jpg?1485675368");
        $chapitre->setQuestion("Ne lui restaient que <b>deux</b> possibilités :");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('Help !');
        $chapitre->setTitreCourt('Help !');
        $chapitre->setTexte("Les Oracles se tournèrent lentement vers lui, les yeux aussi verts qu&#39;une ligne de code sur
        un MO5 et l’écoutèrent attentivement. Après de longs palabres dans une langue connue
        d’eux seuls, ils consentirent à lui répondre dans une langue commune. Ils s’avouaient
        dépassés, il fallait consulter d’autres devins, capables d’autres formes de divinations, Blam
        Blam, Kangoo et Verre brisé, inconnus sous d’autres noms. Seuls ces trois-là sauraient. Peut-
        être. La route serait longue, sinueuse, hasardeuse.");
        $chapitre->setPhoto("https://i.ytimg.com/vi/eVF4kebiks4/maxresdefault.jpg");
        $chapitre->setQuestion("Que faire alors ?");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('Spaceshifter');
        $chapitre->setTitreCourt('Spaceshifter');
        $chapitre->setTexte("En remontant dans son l’habitacle, Un fin sourire trancha son visage en une lame
        courbe, il savait que sa conscience serait transférée rapidement dans une autre
        enveloppe corporelle en cas de problème. Transhumaniste et Marxiste, il fallait bien
        qu’il en reste un pour que ces idées progressistes survivent. Il avait tout prévu. Il ne
        savait pas que si ce n’était pas tout à fait sa dernière pensée, ce serait en tout cas le
        dernier moment de cette enveloppe robotique. Les Solbots avaient encore frappé. Le
        spaceshifter se désintégra sous l’effet cumulé des charges sourdes et subsoniques, la
        nouvelle manière de procéder. Aucun bruit, une oppressante sensation de vide et
        l’implosion.");
        $chapitre->setPhoto("http://4everstatic.com/images/art/film-et-serie/battlestar-galactica,-vaisseau-spatial-172243.jpg");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);

        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);
        $chapitre->setTitre('Voyage interstellaire');
        $chapitre->setTitreCourt('Voyage interstellaire');
        $chapitre->setTexte("Intuitivement, étonné par son incapacité à élaborer un
        raisonnement, il leur fit confiance, prit la route qu’ils leur indiquaient et songea
        malicieusement à LUH 3417, son âme sœur, sa quête, son Graal, celle qui motivait
        ces allers-retours planétaires, sidéraux, ses circuits fatigués, ses calculateurs saturés,
        ce soupçon de lassitude inconnu jusqu’alors. Les oracles lui avaient indiqué que ces
        trois-là sauraient et lui ne savait rien. Il n’avait pas d’autre choix, il le savait,
        intuitivement et rationnellement. LULUH serait peut-être au bout d’un nouveau
        voyage. Il y croyait, ne croyait qu’en ça, n’avait plus que ça. Elle était son tout
        organique et robotique. En route...");
        $chapitre->setPhoto("https://i.ytimg.com/vi/aockugeMFyg/maxresdefault.jpg");
        $chapitre->setPremier(false);
        $manager->persist($chapitre);
        $manager->flush();

        $suite = new Suite();
        $chapitre = $repChapitre->find(8);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(9);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse("Sonner");
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(8);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(10);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse("Téléphoner");
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(8);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(11);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse("Demander conseil au 3 Fred");
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(10);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(11);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse("consulter les oracles aux yeux d’émeraude");
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(10);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(12);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse("remonter dans son spaceshifter dans l’hypothétique espoir d’une rencontre miraculeuse");
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(11);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(12);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse("Rester méfiant et remonter dans son spaceshifter");
        $manager->persist($suite);

        $suite = new Suite();
        $chapitre = $repChapitre->find(11);
        $suite->setChapitreSource($chapitre);
        $chapitre = $repChapitre->find(13);
        $suite->setChapitreDestination($chapitre);
        $suite->setReponse("Leur faire confiance");
        $manager->persist($suite);



        $manager->flush();
    }
}
