export const insertNewMessage = async (elNewMsg, nickname) => {
  await fetch(
    `./src/server/insert_new_message.php?nickname=${nickname}&msg=${elNewMsg.value}`
  );

  elNewMsg.value = "";
};
