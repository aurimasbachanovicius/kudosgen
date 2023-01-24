package main

import (
	"fmt"
	"net/http"

	"github.com/gorilla/websocket"
)

var upgrader = websocket.Upgrader{
	ReadBufferSize:  1024,
	WriteBufferSize: 1024,
	CheckOrigin:     func(r *http.Request) bool { return true },
}

func handleConnections(w http.ResponseWriter, r *http.Request) {
	fmt.Printf("Req: %s %s\n", r.Host, r.URL.Path)

	ws, err := upgrader.Upgrade(w, r, nil)
	if err != nil {
		http.Error(w, "Could not upgrade", http.StatusInternalServerError)
		return
	}
	defer ws.Close()

	for {
		var msg interface{}

		err := ws.ReadJSON(&msg)
		if err != nil {
			fmt.Printf("Failed to read message: %+v\n", err)
			break
		}

		// 		fmt.Println(msg)
	}
}

func main() {
	http.HandleFunc("/ws", handleConnections)
	http.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		w.WriteHeader(http.StatusOK)

		fmt.Fprintf(w, "Req: %s %s\n", r.Host, r.URL.Path)
	})
	err := http.ListenAndServe(":8000", nil)
	if err != nil {
		panic(err)
	}
}
