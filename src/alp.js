export const getData = async (elChat) => {
  const response = await fetch("./src/server/alp.php");

  if (response.status === 502) {
    await getData(elChat);
  } else if (response.status !== 200) {
  } else {
    const message = await response.text();
    console.log(message);
    elChat.innerHTML += message;
    $(".e-message").emoticonize({});

    await getData(elChat);
  }

  getData(elChat);
};
