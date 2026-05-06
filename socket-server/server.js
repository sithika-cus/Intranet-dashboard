const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const axios = require("axios");
const cors = require("cors");

const app = express();

app.use(cors({
    origin: "*",
    methods: ["GET", "POST"]
}));
app.use(express.json());


app.get("/", (req, res) => {
    res.send("Socket server running 🚀");
});

app.post("/post-added", (req, res) => {
    io.emit("new_post");
    res.json({ status: "ok" });
});

const server = http.createServer(app);

const io = new Server(server, {
    cors: {
        origin: "http://intranet.local",
        methods: ["GET", "POST"]
    }
});

// 🔥 SOCKET CONNECTION
io.on("connection", async (socket) => {

    console.log("User connected:", socket.id);

    try {
        // ⚠ Use 127.0.0.1 instead of intranet.loc
        const response = await axios.get("http://127.0.0.1/wall");


        // Send posts to connected user
        socket.emit("load_posts", response.data);

    } catch (error) {

        if (error.response) {
            console.error("Status:", error.response.status);
            console.error("Data:", error.response.data);
        } else {
            console.error("Error:", error.message);
        }

    }

    socket.on("disconnect", () => {
        console.log("User disconnected:", socket.id);
    });

});

const PORT = 3000;

server.listen(PORT, () => {
    console.log(`Socket server running at http://localhost:${PORT}`);
});
