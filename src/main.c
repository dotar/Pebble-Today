#include <pebble.h>

	
enum {
	CONFIG_KEY_SHOW_WEEK = 30,
	CONFIG_KEY_SHOW_MONTH = 31,
	
};

char buffer[256] = "";

int showWeek = 1;
int showMonth = 1;

	
static Window *window;
static Layer *window_layer;
static TextLayer *weekday_layer;

static TextLayer *week_layer;
static TextLayer *day_layer;
static TextLayer *month_layer;
static BitmapLayer *background_layer;
static GBitmap *background_image;
static GFont *weekday_font;

static GFont *week_font;
static GFont *day_font;
static GFont *month_font;

static void draw_display() {
  window_layer = window_get_root_layer(window);
  window_set_background_color(window, GColorBlack);
  
  GRect background_frame = (GRect) {
    .origin = {0,0},
    .size = {144,168}
  };
	
  background_layer = bitmap_layer_create(background_frame);
  background_image = gbitmap_create_with_resource(RESOURCE_ID_IMAGE_BACKGROUND);
  bitmap_layer_set_bitmap(background_layer, background_image);
  layer_add_child(window_layer, bitmap_layer_get_layer(background_layer));
  APP_LOG(APP_LOG_LEVEL_DEBUG, "Pushed background layer: %p", background_layer);

	
	// WEEKDAY
  weekday_layer = text_layer_create(GRect(0, 10, 144 /* width */, 26 /* height */));
  text_layer_set_background_color(weekday_layer, GColorClear);
  text_layer_set_text_color(weekday_layer, GColorWhite);
	text_layer_set_text_alignment(weekday_layer, GTextAlignmentCenter);
  weekday_font = fonts_get_system_font(FONT_KEY_ROBOTO_CONDENSED_21);
  text_layer_set_font(weekday_layer, weekday_font);
  layer_add_child(window_layer, text_layer_get_layer(weekday_layer));
  APP_LOG(APP_LOG_LEVEL_DEBUG, "Pushed time layer: %p", weekday_layer);
	
	
	
	
	
	
	
	
	
	
	
	
	
	// WEEK
  week_layer = text_layer_create(GRect(0, 45, 144-10 /* width */, 26 /* height */));
  text_layer_set_background_color(week_layer, GColorClear);
  text_layer_set_text_color(week_layer, GColorBlack);
	text_layer_set_text_alignment(week_layer, GTextAlignmentRight);
  week_font = fonts_get_system_font(FONT_KEY_ROBOTO_CONDENSED_21);
  text_layer_set_font(week_layer, week_font);
  layer_add_child(window_layer, text_layer_get_layer(week_layer));
  APP_LOG(APP_LOG_LEVEL_DEBUG, "Pushed time layer: %p", weekday_layer);

	// DAY
  day_layer = text_layer_create(GRect(0, 60, 144 /* width */, 70 /* height */));
  text_layer_set_background_color(day_layer, GColorClear);
  text_layer_set_text_color(day_layer, GColorBlack);
	text_layer_set_text_alignment(day_layer, GTextAlignmentCenter);
	day_font = fonts_load_custom_font(resource_get_handle(RESOURCE_ID_FONT_ARIAL_BOLD_62));
  text_layer_set_font(day_layer, day_font);
  layer_add_child(window_layer, text_layer_get_layer(day_layer));
  APP_LOG(APP_LOG_LEVEL_DEBUG, "Pushed time layer: %p", weekday_layer);

	// MONTH
  month_layer = text_layer_create(GRect(0, 168-40, 144 /* width */, 26 /* height */));
  text_layer_set_background_color(month_layer, GColorClear);
  text_layer_set_text_color(month_layer, GColorBlack);
	text_layer_set_text_alignment(month_layer, GTextAlignmentCenter);
	month_font = fonts_get_system_font(FONT_KEY_ROBOTO_CONDENSED_21);
  text_layer_set_font(month_layer, month_font);
  layer_add_child(window_layer, text_layer_get_layer(month_layer));
  APP_LOG(APP_LOG_LEVEL_DEBUG, "Pushed time layer: %p", weekday_layer);

}

static void update_display(struct tm *tick_time) {

	static char weekday_text[] = "WEDNESDAY"; // Needs to be static because it's used by the system later.
	static char week_text[] = "w xx";
	static char day_text[] = "xx";
	static char month_text[] = "September";
	
	static int yday = -1;
	
	// Only update the date when it has changed.
	if (yday != tick_time->tm_yday) {
		// Weekday
		strftime(weekday_text, sizeof(weekday_text), "%A", tick_time);
		text_layer_set_text(weekday_layer, weekday_text);
		
		// Week
		strftime(week_text, sizeof(week_text), "w %V", tick_time);
		text_layer_set_text(week_layer, week_text);
		
		// Day
		strftime(day_text, sizeof(day_text), "%d", tick_time);
		text_layer_set_text(day_layer, day_text);
		
		// Month
		strftime(month_text, sizeof(month_text), "%B", tick_time);
		text_layer_set_text(month_layer, month_text);
		
		
		
		
		
	}
  
	/*
	strftime(weekday_text, sizeof(weekday_text), "%A", tick_time);
	strftime(week_text, sizeof(week_text), "w %V", tick_time);
	strftime(day_text, sizeof(day_text), "%d", tick_time);
	strftime(month_text, sizeof(month_text), "%B", tick_time);

	text_layer_set_text(weekday_layer, weekday_text);
	text_layer_set_text(week_layer, week_text);
	text_layer_set_text(day_layer, day_text);
	text_layer_set_text(month_layer, month_text);
	*/
}

void logVariables(const char *msg) {
	snprintf(buffer, 256, "MSG: %s\n\tshowWeek=%d\n\tshowMonth=%d\n", msg, showWeek, showMonth);
	
	APP_LOG(APP_LOG_LEVEL_DEBUG, buffer);
}

static void handle_tick (struct tm *tick_time, TimeUnits units_changed) {
  
  // If the day was what changed
  update_display(tick_time);
  
}

void applyConfig() {
	if(showWeek){
		text_layer_set_size(week_layer, GSize(134,26));
	}else{
		text_layer_set_size(week_layer, GSize(0,0));
	}

	if(showMonth){
		text_layer_set_size(month_layer, GSize(144,26));
	}else{
		text_layer_set_size(month_layer, GSize(0,0));
	}


	
	
	
	
}

bool checkAndSaveInt(int *var, int val, int key) {
	if (*var != val) {
		*var = val;
		persist_write_int(key, val);
		return true;
	} else {
		return false;
	}
}


void in_dropped_handler(AppMessageResult reason, void *context) {
}

void in_received_handler(DictionaryIterator *received, void *context) {
	bool somethingChanged = false;
	
	Tuple *show_week = dict_find(received, CONFIG_KEY_SHOW_WEEK);
	Tuple *show_month = dict_find(received, CONFIG_KEY_SHOW_MONTH);

	
	if (show_week && show_month) {
		somethingChanged |= checkAndSaveInt(&showWeek, show_week->value->int32, CONFIG_KEY_SHOW_WEEK);
		somethingChanged |= checkAndSaveInt(&showMonth, show_month->value->int32, CONFIG_KEY_SHOW_MONTH);

		
		logVariables("ReceiveHandler");
		
		if (somethingChanged) {
			applyConfig();
		}
	}
}

void readConfig() {
	
	if (persist_exists(CONFIG_KEY_SHOW_WEEK)) {
		showWeek = persist_read_int(CONFIG_KEY_SHOW_WEEK);
	} else {
		showWeek = 1;
	}
	
	if (persist_exists(CONFIG_KEY_SHOW_MONTH)) {
		showMonth = persist_read_int(CONFIG_KEY_SHOW_MONTH);
	} else {
		showMonth = 1;
	}

	
	
	
	
	
	
	logVariables("readConfig");
}

static void app_message_init(void) {
	app_message_register_inbox_received(in_received_handler);
	app_message_register_inbox_dropped(in_dropped_handler);
	app_message_open(64, 64);
}

static void window_load (Window *window) {

  // Actually draw
  draw_display();
}

static void window_unload (Window *window) {
	// Nuke the layers
	bitmap_layer_destroy(background_layer);

	text_layer_destroy(weekday_layer);
	
	text_layer_destroy(week_layer);
	text_layer_destroy(day_layer);
	text_layer_destroy(month_layer);
}
void init(void) {

  window = window_create();
  window_set_window_handlers(window, (WindowHandlers) {
    .load = window_load,
    .unload = window_unload,
  });
  const bool animated = true;
  window_stack_push(window, animated);

	app_message_init();
	readConfig();
	draw_display();

}
void deinit(void) {

	text_layer_destroy(weekday_layer);
	
	text_layer_destroy(week_layer);
	text_layer_destroy(day_layer);
	text_layer_destroy(month_layer);
	bitmap_layer_destroy(background_layer);
	gbitmap_destroy(background_image);

}

int main (void) {
  init();
  //tick_timer_service_subscribe(MINUTE_UNIT, handle_tick);
	tick_timer_service_subscribe(DAY_UNIT, handle_tick);
  APP_LOG(APP_LOG_LEVEL_DEBUG, "Done initializing, pushed window: %p", window);

  app_event_loop();
  deinit();
}