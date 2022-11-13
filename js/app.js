const dd = document.getElementById("nationality");

async function fetchCountries() {
  const response = await fetch("https://restcountries.com/v3.1/all");
  const data = await response.json();
  let names = [];
  let option = "";
  data.forEach((country) => {
    names.push(country.name.common);
    names.sort();
  });
  names.forEach((countryName) => {
    option += `<option value="${countryName}">${countryName}</option>`;
  });
  dd.innerHTML = option;
}

fetchCountries();
