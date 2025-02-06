// Main JavaScript file

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM fully loaded and parsed")
  
    // Example: Close alert messages
    const alerts = document.querySelectorAll(".alert")
    alerts.forEach((alert) => {
      const closeBtn = document.createElement("button")
      closeBtn.innerHTML = "&times;"
      closeBtn.className = "close-btn"
      closeBtn.onclick = () => {
        alert.style.display = "none"
      }
      alert.appendChild(closeBtn)
    })
  
    // Add more JavaScript functionality as needed
  })
  
  