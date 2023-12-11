export const getData = async (elChat, lastID) => {
  let response = "";
  let result = { lastID };
  try {
    response = await fetch(`./src/server/alp.php?lastID=${lastID}`);
  } catch (err) {
    getData(elChat, result.lastID);
  }

  try {
    result = await response.json();
    console.log(result);
    if (result.status) {
      elChat.innerHTML += result.data;
      $(".e-message").emoticonize({
        animate: false,
      });
      getData(elChat, result.lastID);
    }
  } catch (err) {
    console.log(err);
    getData(elChat, result.lastID);
  }
};
