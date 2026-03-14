const INDIA_TIME_ZONE = "Asia/Kolkata";

const countries = [
  { id: "mexico", country: "Mexico", city: "Mexico City", timeZone: "America/Mexico_City" },
  { id: "argentina", country: "Argentina", city: "Buenos Aires", timeZone: "America/Argentina/Buenos_Aires" },
  { id: "spain", country: "Spain", city: "Madrid", timeZone: "Europe/Madrid" },
  { id: "canada", country: "Canada", city: "Ottawa", timeZone: "America/Toronto" },
  { id: "italy", country: "Italy", city: "Rome", timeZone: "Europe/Rome" },
  { id: "chile", country: "Chile", city: "Santiago", timeZone: "America/Santiago" },
  { id: "colombia", country: "Colombia", city: "Bogota", timeZone: "America/Bogota" },
  { id: "brazil", country: "Brazil", city: "Brasilia", timeZone: "America/Sao_Paulo" },
  { id: "australia", country: "Australia", city: "Sydney", timeZone: "Australia/Sydney" },
  { id: "denmark", country: "Denmark", city: "Copenhagen", timeZone: "Europe/Copenhagen" },
  { id: "greece", country: "Greece", city: "Athens", timeZone: "Europe/Athens" },
  { id: "japan", country: "Japan", city: "Tokyo", timeZone: "Asia/Tokyo" },
  { id: "usa", country: "USA", city: "Washington, D.C.", timeZone: "America/New_York" },
  { id: "uk", country: "UK", city: "London", timeZone: "Europe/London" },
  { id: "sweden", country: "Sweden", city: "Stockholm", timeZone: "Europe/Stockholm" },
  { id: "south-africa", country: "South Africa", city: "Johannesburg", timeZone: "Africa/Johannesburg" },
  { id: "philippines", country: "Philippines", city: "Manila", timeZone: "Asia/Manila" },
  { id: "venezuela", country: "Venezuela", city: "Caracas", timeZone: "America/Caracas" },
  { id: "germany", country: "Germany", city: "Berlin", timeZone: "Europe/Berlin" },
  { id: "ireland", country: "Ireland", city: "Dublin", timeZone: "Europe/Dublin" },
  { id: "malaysia", country: "Malaysia", city: "Kuala Lumpur", timeZone: "Asia/Kuala_Lumpur" },
  { id: "switzerland", country: "Switzerland", city: "Zurich", timeZone: "Europe/Zurich" },
  { id: "france", country: "France", city: "Paris", timeZone: "Europe/Paris" },
  { id: "hungary", country: "Hungary", city: "Budapest", timeZone: "Europe/Budapest" },
];

const indiaTimeElement = document.querySelector("#india-time");
const countryGridElement = document.querySelector("#country-grid");

const timeFormatterCache = new Map();
const cardElementMap = new Map();

function getTimeFormatter(timeZone) {
  const cacheKey = `${timeZone}-12h`;
  if (!timeFormatterCache.has(cacheKey)) {
    timeFormatterCache.set(
      cacheKey,
      new Intl.DateTimeFormat("en-US", {
        timeZone,
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
      }),
    );
  }
  return timeFormatterCache.get(cacheKey);
}

function getOffsetMinutes(timeZone, date) {
  const formatter = new Intl.DateTimeFormat("en-US", {
    timeZone,
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit",
    hour12: false,
  });

  const parts = formatter.formatToParts(date);
  const values = {};

  for (const part of parts) {
    if (part.type !== "literal") {
      values[part.type] = Number(part.value);
    }
  }

  const utcTimestamp = Date.UTC(
    values.year,
    values.month - 1,
    values.day,
    values.hour,
    values.minute,
    values.second,
  );

  return Math.round((utcTimestamp - date.getTime()) / 60000);
}

function formatTime(date, timeZone) {
  return getTimeFormatter(timeZone).format(date);
}

function formatDifference(diffMinutes) {
  if (diffMinutes === 0) {
    return "Difference from IST: same time as India";
  }

  const sign = diffMinutes > 0 ? "+" : "-";
  const absoluteMinutes = Math.abs(diffMinutes);
  const hours = Math.floor(absoluteMinutes / 60);
  const minutes = absoluteMinutes % 60;
  const minutesText = minutes ? ` ${minutes}m` : "";

  return `Difference from IST: ${sign}${hours}h${minutesText}`;
}

function formatOffsetBadge(offsetMinutes) {
  const sign = offsetMinutes >= 0 ? "+" : "-";
  const absoluteMinutes = Math.abs(offsetMinutes);
  const hours = Math.floor(absoluteMinutes / 60);
  const minutes = absoluteMinutes % 60;
  const hoursText = String(hours).padStart(2, "0");
  const minutesText = String(minutes).padStart(2, "0");

  return `UTC${sign}${hoursText}:${minutesText}`;
}

function sortCountriesByIndiaDistance(date) {
  const indiaOffset = getOffsetMinutes(INDIA_TIME_ZONE, date);

  return [...countries].sort((left, right) => {
    const leftDiff = getOffsetMinutes(left.timeZone, date) - indiaOffset;
    const rightDiff = getOffsetMinutes(right.timeZone, date) - indiaOffset;

    return (
      Math.abs(leftDiff) - Math.abs(rightDiff) ||
      leftDiff - rightDiff ||
      left.country.localeCompare(right.country)
    );
  });
}

function renderCards(sortedCountries, date) {
  const indiaOffset = getOffsetMinutes(INDIA_TIME_ZONE, date);

  countryGridElement.innerHTML = "";
  cardElementMap.clear();

  sortedCountries.forEach((entry, index) => {
    const offsetMinutes = getOffsetMinutes(entry.timeZone, date);
    const diffMinutes = offsetMinutes - indiaOffset;
    const card = document.createElement("article");
    const countryElement = document.createElement("p");
    const cardTop = document.createElement("div");
    const zoneElement = document.createElement("span");
    const cityElement = document.createElement("p");
    const timeElement = document.createElement("p");
    const differenceElement = document.createElement("p");

    card.className = "time-card";
    card.style.setProperty("--delay", `${index * 45}ms`);
    card.setAttribute("role", "listitem");

    cardTop.className = "card-top";
    countryElement.className = "card-country";
    countryElement.textContent = entry.country;

    zoneElement.className = "card-zone";
    zoneElement.textContent = formatOffsetBadge(offsetMinutes);

    cityElement.className = "card-city";
    cityElement.textContent = `Reference city: ${entry.city}`;

    timeElement.className = "card-time";
    timeElement.textContent = formatTime(date, entry.timeZone);

    differenceElement.className = "card-difference";
    differenceElement.textContent = formatDifference(diffMinutes);

    cardTop.append(countryElement, zoneElement);
    card.append(cardTop, cityElement, timeElement, differenceElement);
    countryGridElement.append(card);

    cardElementMap.set(entry.id, {
      differenceElement,
      timeElement,
      zoneElement,
      timeZone: entry.timeZone,
    });
  });
}

function updateClocks(sortedCountries) {
  const now = new Date();
  const indiaOffset = getOffsetMinutes(INDIA_TIME_ZONE, now);

  indiaTimeElement.textContent = formatTime(now, INDIA_TIME_ZONE);

  sortedCountries.forEach((entry) => {
    const cardElements = cardElementMap.get(entry.id);
    const offsetMinutes = getOffsetMinutes(entry.timeZone, now);
    const diffMinutes = offsetMinutes - indiaOffset;

    cardElements.timeElement.textContent = formatTime(now, entry.timeZone);
    cardElements.zoneElement.textContent = formatOffsetBadge(offsetMinutes);
    cardElements.differenceElement.textContent = formatDifference(diffMinutes);
  });
}

function init() {
  const now = new Date();
  const sortedCountries = sortCountriesByIndiaDistance(now);

  renderCards(sortedCountries, now);
  updateClocks(sortedCountries);
  setInterval(() => updateClocks(sortedCountries), 1000);
}

init();
