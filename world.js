window.addEventListener("DOMContentLoaded", () => {
    const lookupButton =document.getElementById("lookup");
    const input = document.getElementById("country");
    const result = document.getElementById("result");
    const citiesButton = document.getElementById("Lookup-Cities");

    lookupButton.addEventListener("click", () => {
        const country = input.value.trim();

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response =>{
                if(!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => { 
                result.innerHTML = data;
            })
            .catch(error => {
                console.error("Error fetching country data:", error);
                result.innerHTML = "<p>Error fetching country data.</p>";
            });
    });

    citiesButton.addEventListener("click", () => {
        const country = input.value.trim();

        fetch("world.php?country=" + encodeURIComponent(country) + "&lookup=cities")
            .then(response =>{
                if(!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => { 
                result.innerHTML = data;
            })
            .catch(error => {
                console.error("Error fetching city data:", error);
                result.innerHTML = "<p>Error fetching city data.</p>";
            });
    });
});