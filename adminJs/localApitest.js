fetch('http://localhost:3000')
  .then((response) => {
    return response.json();
  })
  .then((myJson) => {
    console.log(myJson);
  });