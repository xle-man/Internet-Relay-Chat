export const getData = async (elChat, lastID) => {
  const response = await fetch(`./src/server/alp.php?lastID=${lastID}`);

  if (response.status === 502) {
    await getData(elChat, lastID);
  } else if (response.status !== 200) {
  } else {
    const result = await response.json();
    if (result.status) {
      elChat.innerHTML += result.data;
      $(".e-message").emoticonize({});
    }

    // setTimeout(async () => {
    await getData(elChat, result.lastID);
    // }, 1000);
  }
};
