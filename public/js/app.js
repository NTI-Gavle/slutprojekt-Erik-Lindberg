function toggleBioEdit() {
    const edbio = document.getElementById("bioEditor");
    const bio = document.getElementById("bio");
    const biobtn = document.getElementById("biobtn");

    if (edbio.style.display === "none") {
        edbio.style.display = "block";
        bio.style.display = "none";
        biobtn.style.display = "none";

    } else {
        edbio.style.display = "none";
        bio.style.display = "block";
        biobtn.style.display = "block";
    }
}