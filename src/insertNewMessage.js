export const insertNewMessage = async (elNewMsg, nickname, isCommand) => {
  await fetch(
    `./src/server/insert_new_message.php?nickname=${nickname}&msg=${elNewMsg.value}&isCommand=${isCommand}`
  );

  elNewMsg.value = "";
};
