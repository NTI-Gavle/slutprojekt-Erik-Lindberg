    const canvas = document.getElementById("Canvas");
    const ctx = canvas.getContext("2d");

    const cx = 80;
    const cy = 80;
    const radius = 65;

    function draw() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        const ms = now.getMilliseconds();

        const timeString =
            String(hours).padStart(2, "0") + ":" +
            String(minutes).padStart(2, "0") + ":" +
            String(seconds).padStart(2, "0");

        ctx.clearRect(0, 0, 160, 160);

        ctx.beginPath();
        ctx.arc(cx, cy, radius, 0, Math.PI * 2);
        ctx.strokeStyle = "#1E3447";
        ctx.lineWidth = 8;
        ctx.stroke();

        const secProgress = (seconds + ms / 1000) / 60;
        ctx.beginPath();
        ctx.arc(cx, cy, radius, -Math.PI / 2, (Math.PI * 2 * secProgress) - Math.PI / 2);
        ctx.strokeStyle = "#8a7dff";
        ctx.lineWidth = 6;
        ctx.shadowBlur = 15;
        ctx.shadowColor = "#8a7dff";
        ctx.stroke();

        ctx.shadowBlur = 0;

        ctx.beginPath();
        ctx.arc(cx, cy, 50, 0, Math.PI * 2);
        ctx.fillStyle = "#231B35";
        ctx.fill();

        ctx.font = "bold 16px Arial";
        ctx.fillStyle = "#cfc7ff";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";

        ctx.shadowColor = "#8a7dff";
        ctx.shadowBlur = 10;
        ctx.fillText(timeString, cx, cy);

        ctx.shadowBlur = 0;

        requestAnimationFrame(draw);
    }

    draw();

    

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