export const getData = async (elChat) => {
  const response = await fetch("./src/server/alp.php");
  const result = await response.json();

  if (result.status) {
    console.log(result.data);
    elChat.innerHTML += result.data;
  }
  getData(elChat);
};
