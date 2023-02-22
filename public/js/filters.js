//lorsque les éléments sont bien chargés
window.onload = () => {

    //formulaire connecté au checkbox dans le template
    const FiltersForm = document.querySelector("#filter");

    //boucle sur les éléments du checkbox
    document.querySelectorAll("#filter input").forEach(input => {

        //ajout d'un événements qui s'enclanche après que l'utilisateur ait coché une case
        input.addEventListener("change", () => {

            //récupération des données du formulaire
            const Form = new FormData(FiltersForm);

            //création de l'URL contenant les données du filtrage
            const Params = new URLSearchParams();
            http://snowaddict-symfony.local/homepage/?fives%5B%5D=1&fives%5B%5D=2&levels%5B%5D=intermediate&ajax=1


                Form.forEach((value,key) => {

                //ajoute les informations sélectionnés au fur et à mesure dans l'objet URL
                Params.append(key, value);
                //exemple : on obtient une url de ce type -> five%5B%5D=1&five%5B%5D=2 (deux fives cochés)
            })

            //récupère l'url de la page active
            const Url = new URL(window.location.href);


            //requête Ajax qui va customiser la nouvelle Url
            // ancienne URL suivi d'un ? avec les param du filtrage
            // ajax=1 pour transmettre l'information au controleur que la requête a bien eu lieu
            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
                headers: {
                    //méthodologie ajax classique
                    "x-Requested-With": "XMLHttpRequest"
                }
            }).then( //réponse traitée en json
                response => response.json()
            ).then(
                data => { //data récupère ce qui a été traité par le json
                    //zone de contenu affichée dans le template (avant la boucle for de l'affichage des matchs)
                    const content = document.querySelector("#content");

                    //contenu modifié avec les infos issus de data
                    content.innerHTML = data.content;
                }


            )
                .catch(e => alert(e)); //gestion de l'exception
        })
    })
}