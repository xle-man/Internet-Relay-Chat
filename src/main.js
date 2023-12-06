const elChat = document.getElementById("chat");
const elNewMsg = document.getElementById("new-msg");

//Nickname
let nickname = prompt("Nickname:");

const checkNickname = async () => {
  const response = await fetch(
    `./src/server/checkNickname.php?nickname=${nickname}`
  );
  const result = await response.json();

  if (!result["result"]) {
    nickname = prompt("This nickname already exists. Type new one:");
    checkNickname();
  }
};
nickname && checkNickname();

//New Message
const newMessage = async () => {
  const response = await fetch(
    `./src/server/newMsg.php?nickname=${nickname}&msg=${elNewMsg.value}`
  );
  const result = await response.text();

  console.log(result);

  elNewMsg.value = "";
};

elNewMsg.addEventListener("keydown", (e) => {
  e.key === "Enter" && newMessage();
});
