
const body = document.querySelector("body");
const sidebar = body.querySelector(".sidebar");
const sidebarToggle = body.querySelector(".sidebar-toggle");

let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "close") {
  sidebar.classList.toggle("close");
}

sidebarToggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  if (sidebar.classList.contains("close")) {
    localStorage.setItem("status", "close");
  } else {
    localStorage.setItem("status", "open");
  }
});

sidebarToggle.onclick = function () {
  sidebar.classList.toggle("active");
  if (sidebar.classList.contains("active")) {
    sidebarToggle.classList.replace("bx-menu", "bx-menu-alt-right");
  } else sidebarToggle.classList.replace("bx-menu-alt-right", "bx-menu");
};


//elemen input dan tombol search
const searchInput = document.querySelector('.search-box input');
const searchButton = document.querySelector('.search-box i');

//event listener saat tombol search diklik
searchButton.addEventListener('click', () => {
  search();
});

//event listener saat tombol enter ditekan pada keyboard
searchInput.addEventListener('keydown', (event) => {
  if (event.key === 'Enter') {
    search();
  }
});

function search() {
  const searchText = searchInput.value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');

  rows.forEach((row) => {
    const columns = row.getElementsByTagName('td');
    let found = false;

    Array.from(columns).forEach((column) => {
      const text = column.textContent.toLowerCase();

      // Memeriksa apakah nilai kolom mengandung teks pencarian
      if (text.includes(searchText)) {
        found = true;
      }
    });

    if (found) {
      row.style.display = 'table-row';
    } else {
      row.style.display = 'none';
    }
  });
}



 