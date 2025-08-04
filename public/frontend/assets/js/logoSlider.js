const track = document.getElementById("logoTrack");
      let interval = 3000;

      setInterval(() => {
        const firstLogo = track.children[0];
        const logoWidth =
          firstLogo.offsetWidth +
          parseInt(getComputedStyle(firstLogo).marginRight);

        track.style.transition = "transform 0.6s ease-in-out";
        track.style.transform = `translateX(-${logoWidth}px)`;

        setTimeout(() => {
          track.style.transition = "none";
          track.appendChild(firstLogo);
          track.style.transform = "translateX(0)";
        }, 600);
      }, interval);