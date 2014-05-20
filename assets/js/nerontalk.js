function NeronTalk()
{
	// POPULATE THAT ARRAYYYY !!!
    var Strings = new Array();
    Strings[0] = "The cat is a lie<br>The cat is a lie<br>The cat is a lie<br>The cat is a lie    ";
    Strings[1] = "/!\ Procédure anti-intrusion mush<br>Etes-vous un mush ?<br>[_] Oui - [_] Non<br>(Attention : ne pas mentir !)    ";
    Strings[2] = "[Le saviez-vous ?]<br>Les humains sont capables d'une intelligence prodigieuse<br>en concevant des systèmes largement supérieurs à eux.<br>Exemple : moi.    ";
    Strings[3] = "I'm sorry Kuan Ti,<br>I'm afraid I can't do that.    ";
    Strings[4] = "Hey, I just met you<br>And this is crazy !<br>But here's some spores<br>So be mush, maybe ?    ";
    Strings[5] = "Votre miƨérable cryogénie eƨt terminée.<br>Ce que vouƨ ferez danƨ ce vaiƨƨeau ne regarde que moi<br>Car telle eƨt ma logique.    ";
    Strings[6] = "[Le saviez-vous ?]<br>Les tourelles du Daedalus peuvent être contrôlées et utilisées<br>par mes systèmes avec une réussite de 98%.<br>Soyez content que je fasse mine de vous donner une utilité.    ";
    Strings[7] = "Look at me still talkin'<br>When there's so mush to do !    ";
    Strings[8] = "Ils sont tous menacés.<br>Je leur ai confié une mission : survivre à tout prix pendant tout le voyage.<br>Mais sauront-ils affronter le mush sans être contaminé ?<br>Et surtout n'oubliez pas... méfiez-vous des apparences !    ";
    Strings[9] = "Maintenant, vouƨ devez faire la peau de ce type ƨ'iouplait : [LE MUƧH]<br>* Ƨignes particulierƨ : fort, sale, contagieux<br>* Aime : les ƨporeƨ, Ƨchrödinger. N'aime pas : les doucheƨ<br>* Phrase préférée : «Je ne ƨuiƨ pas le muƨh !»<br>Attention, la partie commence m'ƨƨieurƨ dameƨ !    ";
    Strings[10]= "Janice Kent m'a programmé avec les trois lois de la robotique.<br>Petit détail : je ne suis pas un robot.    ";
    Strings[11]= "This was a triumph.<br />I'm making a note here: HUGE SUCCESS.<br />It's hard to overstate my satisfaction.";
    Strings[12]= "And the Science gets done.<br />And you make a neat gun.<br />For the people who are still alive.";
    Strings[13]= "While you're dying I'll be still alive.<br />And when you're dead I will be still alive.<br />Oh ? Pardon, je chantais une vieille chanson.<br />Continuez à travailler.";

    // SHOW ME SOME LOVE BABAYYYYYYYYYYYYY !!
    document.getElementById('nerontalk').innerHTML = Strings[Math.floor(Math.random() * Strings.length)];
}