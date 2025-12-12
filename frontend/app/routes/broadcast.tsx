import { useEffect, useState } from "react";
import { getEcho } from "../lib/echo-client";

export default function Home() {
  const [events, setEvents] = useState<
    { status: string; message: string; time: string }[]
  >([]);

  const [message, setMessage] = useState("");
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    const echo = getEcho();
    if (!echo) return;

    echo.channel("public").listen(".testBroadcasted", (data: any) => {
      setEvents((prev) => [...prev, data]);
    });

    return () => {
      echo.leave("public");
    };
  }, []);

  async function sendTestBroadcast() {
    setLoading(true);

    try {
      const response = await fetch("http://localhost:8080/api/diagnostics/broadcast-test", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: message.trim() ? JSON.stringify({ message }) : undefined,
      });

      await response.json();
    } catch (e) {
      console.error("Broadcast request error:", e);
    } finally {
      setLoading(false);
      setMessage("");
    }
  }

  return (
    <div className="max-w-2xl mx-auto p-6 font-sans">
      <h1 className="text-2xl font-bold mb-6">Тест Laravel Broadcasts</h1>

      <div className="flex items-center gap-3 mb-6">
        <input
          type="text"
          className="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
          placeholder="Введите сообщение (необязательно)"
          value={message}
          onChange={(e) => setMessage(e.target.value)}
        />

        <button
          onClick={sendTestBroadcast}
          disabled={loading}
          className={`px-4 py-2 rounded-lg text-white transition ${
            loading ? "bg-gray-400 cursor-not-allowed" : "bg-indigo-600 hover:bg-indigo-700"
          }`}
        >
          {loading ? "Отправка..." : "Отправить"}
        </button>
      </div>

      {events.length === 0 && (
        <p className="text-gray-500">Ожидание событий…</p>
      )}

      <div className="space-y-4 mt-4">
        {events.map((e, i) => (
          <div
            key={i}
            className="p-4 border border-gray-300 rounded-lg shadow-sm bg-white"
          >
            <p><span className="font-semibold">Статус:</span> {e.status}</p>
            <p><span className="font-semibold">Сообщение:</span> {e.message}</p>
            <p><span className="font-semibold">Время:</span> {e.time}</p>
          </div>
        ))}
      </div>
    </div>
  );
}