




function izmeni(id){
    var id1=id

    window.location="izmeni.php?id="+id1

    return false
}

function brisi(id)
    {
        var odgovor=confirm("Brisanje korisnika: Da li ste sigurni?");
        if (odgovor)
        window.location = "brisi.php?id="+id;
    }