import { checkNickname, generateNickname } from "./checkNickname.js";

const elChat = document.getElementById("chat");
const elNewMsg = document.getElementById("new-msg");

let nickname = prompt("Nickname:") || generateNickname();
nickname = await checkNickname(nickname);

//New Message
const newMessage = async () => {
  const response = await fetch(
    `./src/server/newMsg.php?nickname=${nickname}&msg=${elNewMsg.value}`
  );
  const result = await response.text();

  // console.log(result);

  elNewMsg.value = "";
};

elNewMsg.addEventListener("keydown", (e) => {
  e.key === "Enter" && newMessage();
});
